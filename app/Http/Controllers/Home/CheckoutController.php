<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HoaDon;
use App\Models\ChiTietHoaDon;
use App\Models\TinhThanh;
use App\Models\QuanHuyen;
use App\Models\PhuongXa;
use App\Models\DiaChiNhanHang;
use App\Models\CartHold;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        // (Giữ nguyên logic index như hiện tại)
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thanh toán.');
        }

        $userId = Auth::id();
        $sessionId = Session::getId();
        $promo = session('promo');
        $discountAmount = 0;
        $shipping = 0;
        $addresses = Auth::user()->addresses ?? collect();

        // (Giữ nguyên logic gộp cart, dọn dẹp, tính toán subtotal, total, v.v.)
        $duplicateHolds = CartHold::where('user_id', $userId)
            ->where('session_id', $sessionId)
            ->groupBy(['user_id', 'session_id', 'book_id'])
            ->havingRaw('COUNT(*) > 1')
            ->select(['book_id', \DB::raw('COUNT(*) as count'), \DB::raw('SUM(quantity) as total_quantity')])
            ->get();

        foreach ($duplicateHolds as $duplicate) {
            $firstId = CartHold::where('user_id', $userId)
                ->where('session_id', $sessionId)
                ->where('book_id', $duplicate->book_id)
                ->min('id');
            CartHold::where('id', $firstId)->update(['quantity' => $duplicate->total_quantity]);
            CartHold::where('user_id', $userId)
                ->where('session_id', $sessionId)
                ->where('book_id', $duplicate->book_id)
                ->where('id', '!=', $firstId)
                ->delete();
        }

        CartHold::where('user_id', $userId)
            ->where(function ($q) use ($sessionId) {
                $q->where('session_id', '!=', $sessionId)
                    ->orWhere('created_at', '<', now()->subHours(24));
            })->delete();

        $cartItems = CartHold::where('user_id', $userId)
            ->where('session_id', $sessionId)
            ->with(['book' => function ($q) {
                $q->select('MaSach', 'TenSach', 'GiaBan', 'HinhAnh');
            }])->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống.');
        }

        $groupedCartItems = $cartItems->groupBy('book_id')->map(function ($items) {
            $first = $items->first();
            return [
                'book' => [
                    'MaSach' => $first->book->MaSach,
                    'TenSach' => $first->book->TenSach,
                    'GiaBan' => $first->book->GiaBan,
                    'HinhAnh' => $first->book->HinhAnh,
                ],
                'quantity' => $items->sum('quantity')
            ];
        })->values();

        if ($groupedCartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng không hợp lệ.');
        }

        $subtotal = $groupedCartItems->sum(fn($item) => $item['quantity'] * $item['book']['GiaBan']);

        if ($promo) {
            $discountAmount = $promo['Kieu'] === 'percent'
                ? ($subtotal * $promo['GiaTri']) / 100
                : $promo['GiaTri'];
        }

        $total = max(0, $subtotal + $shipping - $discountAmount);
        Session::put('groupedCartItems', $groupedCartItems->toArray());

        $tinhThanhs = TinhThanh::select('id', 'ten')->orderBy('ten')->get();

        return view('homepage.checkout', compact(
            'groupedCartItems',
            'subtotal',
            'shipping',
            'total',
            'tinhThanhs',
            'discountAmount',
            'promo',
            'addresses'
        ));
    }

    public function store(Request $request)
    {
        Log::info('Checkout request data:', $request->all());
        try {
            $userId = Auth::id();
            $sessionId = Session::getId();

            Log::info('Bắt đầu xử lý đặt hàng', [
                'user_id' => $userId,
                'session_id' => $sessionId,
                'request_data' => $request->all()
            ]);

            // Xác định địa chỉ
            $addressData = [];
            if ($request->filled('dia_chi_id')) {
                // Nếu chọn địa chỉ có sẵn
                $address = DiaChiNhanHang::where('id', $request->dia_chi_id)
                    ->where('khachhang_id', $userId)
                    ->firstOrFail();

                $addressData = [
                    'ten_nguoi_nhan' => $address->ten_nguoi_nhan,
                    'so_dien_thoai' => $address->so_dien_thoai,
                    'dia_chi_cu_the' => $address->dia_chi_cu_the,
                    'tinh_thanh_id' => $address->tinh_thanh_id,
                    'quan_huyen_id' => $address->quan_huyen_id,
                    'phuong_xa_id' => $address->phuong_xa_id,
                ];
            } else {
                // Nếu nhập địa chỉ mới
                $addressData = $request->validate([
                    'ten_nguoi_nhan' => 'required|string|max:255',
                    'so_dien_thoai' => 'required|string|regex:/^0[0-9]{9}$/',
                    'dia_chi_cu_the' => 'required|string|max:255',
                    'tinh_thanh_id' => 'required|exists:tinh,id',
                    'quan_huyen_id' => 'required|exists:quanhuyen,id',
                    'phuong_xa_id' => 'required|exists:phuongxa,id',
                ], [
                    'ten_nguoi_nhan.required' => 'Vui lòng nhập Họ và Tên người nhận.',
                    'so_dien_thoai.required' => 'Vui lòng nhập Số điện thoại.',
                    'so_dien_thoai.regex' => 'Số điện thoại phải bắt đầu bằng 0 và có 10 chữ số.',
                    'dia_chi_cu_the.required' => 'Vui lòng nhập Địa chỉ cụ thể.',
                    'tinh_thanh_id.required' => 'Vui lòng chọn Tỉnh/Thành phố.',
                    'tinh_thanh_id.exists' => 'Tỉnh/Thành phố không hợp lệ.',
                    'quan_huyen_id.required' => 'Vui lòng chọn Quận/Huyện.',
                    'quan_huyen_id.exists' => 'Quận/Huyện không hợp lệ.',
                    'phuong_xa_id.required' => 'Vui lòng chọn Phường/Xã.',
                    'phuong_xa_id.exists' => 'Phường/Xã không hợp lệ.',
                ]);
            }

            // Validate các trường chung
            $validated = $request->validate([
                'total' => 'required|numeric|min:0',
                'phuong_thuc_thanh_toan' => 'required|in:cod,vnpay',
                'ghi_chu' => 'nullable|string|max:1000',
            ], [
                'total.required' => 'Tổng tiền không được để trống.',
                'total.numeric' => 'Tổng tiền phải là số.',
                'total.min' => 'Tổng tiền không hợp lệ.',
                'phuong_thuc_thanh_toan.required' => 'Vui lòng chọn Phương thức thanh toán.',
                'phuong_thuc_thanh_toan.in' => 'Phương thức thanh toán không hợp lệ.',
            ]);

            $validated = array_merge($validated, $addressData, ['khachhang_id' => $userId]);
            $groupedCartItems = session('groupedCartItems', []);

            if (empty($groupedCartItems)) {
                Log::warning('Giỏ hàng rỗng trong session', ['user_id' => $userId]);
                return redirect()->route('cart.index')->with('error', 'Giỏ hàng rỗng.');
            }

            $cartTotal = collect($groupedCartItems)->sum(fn($item) => $item['quantity'] * $item['book']['GiaBan']);
            $promo = session('promo');
            $discountAmount = $promo ? (
                $promo['Kieu'] === 'percent'
                ? ($cartTotal * $promo['GiaTri']) / 100
                : $promo['GiaTri']
            ) : 0;
            $shipping = 0;
            $expectedTotal = max(0, $cartTotal + $shipping - $discountAmount);

            Log::debug('Tính toán đơn hàng', [
                'cartTotal' => $cartTotal,
                'discount' => $discountAmount,
                'shipping' => $shipping,
                'expectedTotal' => $expectedTotal,
                'validatedTotal' => $validated['total']
            ]);

            if (abs($expectedTotal - $validated['total']) > 0.01) {
                Log::warning('Tổng tiền không khớp', [
                    'expected' => $expectedTotal,
                    'submitted' => $validated['total']
                ]);
                return redirect()->back()->with('error', 'Tổng tiền không khớp với giỏ hàng. Vui lòng kiểm tra lại.');
            }

            if ($request->input('phuong_thuc_thanh_toan') === 'vnpay') {
                $diaChi = [
                    'ten_nguoi_nhan' => $validated['ten_nguoi_nhan'],
                    'so_dien_thoai' => $validated['so_dien_thoai'],
                    'dia_chi_cu_the' => $validated['dia_chi_cu_the'],
                    'tinh_thanh_id' => $validated['tinh_thanh_id'],
                    'quan_huyen_id' => $validated['quan_huyen_id'],
                    'phuong_xa_id' => $validated['phuong_xa_id'],
                ];

                session()->put('vnpay_order', [
                    'validated' => $validated,
                    'groupedCartItems' => $groupedCartItems,
                    'cartTotal' => $cartTotal,
                    'discountAmount' => $discountAmount,
                    'shipping' => $shipping,
                    'expectedTotal' => $expectedTotal,
                    'diaChi' => $diaChi,
                ]);

                Log::info('Chuyển hướng sang VNPay', [
                    'user_id' => $userId,
                    'expectedTotal' => $expectedTotal
                ]);

                return response()->make('
                    <form id="vnpayForm" method="POST" action="' . route('vnpay.payment') . '">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                    </form>
                    <script>document.getElementById("vnpayForm").submit();</script>
                ');
            }

            // Xử lý COD
            $methodMap = ['cod' => 1, 'vnpay' => 2];
            $methodId = $methodMap[$request->input('phuong_thuc_thanh_toan')] ?? null;
            $tinhThanh = TinhThanh::find($validated['tinh_thanh_id']) ?->ten;
            $quanHuyen = QuanHuyen::find($validated['quan_huyen_id']) ?->ten;
            $phuongXa = PhuongXa::find($validated['phuong_xa_id']) ?->ten;

            $diaChiDayDu = "{$validated['dia_chi_cu_the']}, {$phuongXa}, {$quanHuyen}, {$tinhThanh}";
            Log::debug('Tạo hóa đơn mới', ['method_id' => $methodId]);

            $hoadon = HoaDon::create([
                'MaKhachHang' => $userId,
                'NgayLap' => now(),
                'TongTien' => $cartTotal,
                'DiaChi' => $diaChiDayDu,
                'TenNguoiNhan' => $validated['ten_nguoi_nhan'],
                'SoDienThoai' => $validated['so_dien_thoai'],
                'TrangThai' => 'Đang chờ',
                'PT_ThanhToan' => $methodId,
            ]);

            foreach ($groupedCartItems as $item) {
                ChiTietHoaDon::create([
                    'MaHoaDon' => $hoadon->MaHoaDon,
                    'MaSach' => $item['book']['MaSach'],
                    'SoLuong' => $item['quantity'],
                    'DonGia' => $item['book']['GiaBan'],
                ]);
            }
            app(\App\Http\Controllers\Home\InventoryController::class)->reserveStock($hoadon->MaHoaDon);
            if ($request->has('save-address')) {
                $isFirstAddress = DiaChiNhanHang::where('khachhang_id', $userId)->count() === 0;
                $existing = DiaChiNhanHang::where([
                    'khachhang_id' => $userId,
                    'ten_nguoi_nhan' => $validated['ten_nguoi_nhan'],
                    'so_dien_thoai' => $validated['so_dien_thoai'],
                    'dia_chi_cu_the' => $validated['dia_chi_cu_the'],
                    'tinh_thanh_id' => $validated['tinh_thanh_id'],
                    'quan_huyen_id' => $validated['quan_huyen_id'],
                    'phuong_xa_id' => $validated['phuong_xa_id'],
                ])->first();

                if (!$existing) {
                    DiaChiNhanHang::create([
                        'khachhang_id' => $userId,
                        'ten_nguoi_nhan' => $validated['ten_nguoi_nhan'],
                        'so_dien_thoai' => $validated['so_dien_thoai'],
                        'dia_chi_cu_the' => $validated['dia_chi_cu_the'],
                        'tinh_thanh_id' => $validated['tinh_thanh_id'],
                        'quan_huyen_id' => $validated['quan_huyen_id'],
                        'phuong_xa_id' => $validated['phuong_xa_id'],
                        'MacDinh' => $isFirstAddress,
                    ]);
                }
            }

            Session::forget(['groupedCartItems', 'promo', 'cart']);
            CartHold::where('user_id', $userId)->where('session_id', $sessionId)->delete();

            Log::info('Đặt hàng thành công', ['user_id' => $userId]);
            return redirect()->route('account')->with('success', 'Đặt hàng thành công!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Lỗi validation khi đặt hàng: ' . $e->getMessage(), [
                'errors' => $e->errors(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);
            return redirect()->back()->withErrors($e->errors())->withInput();

        } catch (\Throwable $e) {
            Log::error('Lỗi không xác định khi đặt hàng: ' . $e->getMessage(), [
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi đặt hàng. Vui lòng thử lại hoặc liên hệ hỗ trợ.')->withInput();
        }
    }
}
