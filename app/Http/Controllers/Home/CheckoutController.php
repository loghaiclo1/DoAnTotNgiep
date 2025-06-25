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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            $returnUrl = request()->url();
            return redirect()->route('login')->with('returnUrl', $returnUrl)->with('error', 'Vui lòng đăng nhập để thanh toán.');
        }

        $userId = Auth::id();
        $sessionId = Session::getId();
        $promo = session('promo');
        $discountAmount = 0;

        // Làm sạch CartHold không thuộc session hiện tại hoặc cũ hơn 24 giờ
        CartHold::where('user_id', $userId)
            ->where(function ($query) use ($sessionId) {
                $query->where('session_id', '!=', $sessionId)
                    ->orWhere('created_at', '<', now()->subHours(24));
            })
            ->delete();

        // Lấy giỏ hàng từ CartHold cho user và session hiện tại
        $cartItems = CartHold::where('user_id', $userId)
            ->where('session_id', $sessionId)
            ->with('book')
            ->get();

        // Log dữ liệu CartHold thô
        Log::info('CartHold raw data', [
            'user_id' => $userId,
            'session_id' => $sessionId,
            'cartItems' => $cartItems->toArray(),
        ]);

        // Nhóm sản phẩm theo book_id
        $groupedCartItems = $cartItems->groupBy('book_id')->map(function ($items) {
            $firstItem = $items->first();
            return [
                'book' => $firstItem->book,
                'quantity' => $items->sum('quantity'),
            ];
        })->values();

        // Kiểm tra giỏ hàng trống
        if ($groupedCartItems->isEmpty()) {
            Log::warning('Giỏ hàng trống sau khi nhóm', [
                'user_id' => $userId,
                'session_id' => $sessionId
            ]);
            return redirect()->route('cart')->with('error', 'Giỏ hàng trống. Vui lòng thêm sản phẩm.');
        }

        // Kiểm tra dữ liệu hợp lệ
        foreach ($groupedCartItems as $item) {
            if (!isset($item['book']['MaSach'], $item['book']['GiaBan']) || $item['quantity'] <= 0) {
                Log::error('Dữ liệu giỏ hàng không hợp lệ', [
                    'user_id' => $userId,
                    'item' => $item
                ]);
                return redirect()->route('cart')->with('error', 'Dữ liệu giỏ hàng không hợp lệ. Vui lòng kiểm tra lại.');
            }
        }

        // Tính tổng tiền
        $subtotal = $groupedCartItems->sum(function ($item) {
            return $item['quantity'] * $item['book']['GiaBan'];
        });

        // Áp dụng khuyến mãi
        if ($promo) {
            Log::info('Áp dụng khuyến mãi', ['promo' => $promo]);
            if ($promo['Kieu'] === 'percent') {
                $discountAmount = ($subtotal * $promo['GiaTri']) / 100;
            } else {
                $discountAmount = $promo['GiaTri'];
            }
        }

        $shipping = 0;
        $total = max(0, $subtotal + $shipping - $discountAmount);

        // Log dữ liệu trước khi render
        Log::info('Checkout index data', [
            'user_id' => $userId,
            'session_id' => $sessionId,
            'groupedCartItems' => $groupedCartItems->toArray(),
            'subtotal' => $subtotal,
            'discountAmount' => $discountAmount,
            'total' => $total,
            'promo' => $promo,
            'total_quantity' => $groupedCartItems->sum('quantity'),
            'total_items' => count($groupedCartItems),
        ]);

        // Lưu groupedCartItems vào session, xóa dữ liệu cũ
        Session::forget('groupedCartItems');
        Session::put('groupedCartItems', $groupedCartItems->toArray());

        $tinhThanhs = TinhThanh::select('id', 'ten')->orderBy('ten')->get();
        return view('homepage.checkout', compact('groupedCartItems', 'subtotal', 'shipping', 'total', 'tinhThanhs'));
    }

    public function store(Request $request)
    {

        try {
            $userId = Auth::id();
            $sessionId = Session::getId();
            Log::debug('groupedCartItems in session trước khi đặt hàng:', [
                'session_id' => $sessionId,
                'data' => session('groupedCartItems')
            ]);

            Log::info('Bắt đầu xử lý đơn hàng', [
                'request' => $request->all(),
                'user_id' => $userId,
                'session_id' => $sessionId,
                'cart' => session('groupedCartItems', []),
            ]);

            if (!Auth::check()) {
                Log::error('Người dùng chưa đăng nhập', ['session_id' => $sessionId]);
                return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để đặt hàng.');
            }

            // Xác thực dữ liệu
            $validated = $request->validate([
                'khachhang_id' => 'required|exists:khachhang,MaKhachHang',
                'ten_nguoi_nhan' => 'required|string|max:255',
                'so_dien_thoai' => 'required|regex:/^[0-9]{10}$/',
                'tinh_thanh_id' => 'required|exists:tinh_thanhs,id',
                'quan_huyen_id' => 'required|exists:quan_huyens,id',
                'phuong_xa_id' => 'required|exists:phuong_xas,id',
                'dia_chi_cu_the' => 'required|string|max:255',
                'payment_method' => 'required|in:cod,vnpay',
                'subtotal' => 'required|numeric|min:0',
                'shipping' => 'required|numeric|min:0',
                'total' => 'required|numeric|min:0',
                'ghi_chu' => 'nullable|string|max:1000',
            ]);

            Log::info('Xác thực dữ liệu thành công', [
                'user_id' => $userId,
                'validated' => $validated
            ]);

            // Lấy giỏ hàng từ session
            $groupedCartItems = session('groupedCartItems', []);
            if (empty($groupedCartItems)) {
                Log::error('Giỏ hàng rỗng', [
                    'user_id' => $userId,
                    'khachhang_id' => $request->khachhang_id
                ]);
                return redirect()->back()->with('error', 'Giỏ hàng rỗng. Vui lòng thêm sản phẩm.');
            }

            // Kiểm tra dữ liệu giỏ hàng
            foreach ($groupedCartItems as $item) {
                if (!isset($item['book']['MaSach'], $item['book']['GiaBan'], $item['quantity']) || $item['quantity'] <= 0) {
                    Log::error('Dữ liệu giỏ hàng không hợp lệ', [
                        'user_id' => $userId,
                        'item' => $item
                    ]);
                    return redirect()->back()->with('error', 'Dữ liệu giỏ hàng không hợp lệ.');
                }
            }

            // Tính toán tổng tiền và kiểm tra
            $cartItemCount = count($groupedCartItems);
            $cartTotal = 0;
            $cartDetails = [];

            Session::forget(['groupedCartItems', 'promo']);
            CartHold::where('user_id', $userId)->where('session_id', $sessionId)->delete();

            foreach ($groupedCartItems as $item) {
                $cartTotal += $item['quantity'] * $item['book']['GiaBan'];
                $cartDetails[] = [
                    'MaSach' => $item['book']['MaSach'],
                    'TenSach' => $item['book']['TenSach'],
                    'Quantity' => $item['quantity'],
                    'GiaBan' => $item['book']['GiaBan'],
                ];
            }

            $promo = session('promo');
            $discountAmount = 0;
            if ($promo) {
                if ($promo['Kieu'] === 'percent') {
                    $discountAmount = ($cartTotal * $promo['GiaTri']) / 100;
                } else {
                    $discountAmount = $promo['GiaTri'];
                }
            }

            $shipping = $request->shipping;
            $expectedTotal = max(0, $cartTotal + $shipping - $discountAmount);

            // Kiểm tra tổng tiền
            if (round($expectedTotal) != round($request->total)) {
                Log::error('Tổng tiền không khớp', [
                    'user_id' => $userId,
                    'request_total' => $request->total,
                    'calculated_total' => $expectedTotal,
                    'cart_total' => $cartTotal,
                    'discount_amount' => $discountAmount,
                    'cart_count' => $cartItemCount,
                    'cart_details' => $cartDetails,
                ]);
                return redirect()->back()->with('error', 'Tổng tiền không hợp lệ. Vui lòng kiểm tra giỏ hàng.');
            }

            // Tạo địa chỉ giao hàng
            $tinhThanh = TinhThanh::findOrFail($request->tinh_thanh_id)->ten;
            $quanHuyen = QuanHuyen::findOrFail($request->quan_huyen_id)->ten;
            $phuongXa = PhuongXa::findOrFail($request->phuong_xa_id)->ten;
            $diaChi = "{$request->dia_chi_cu_the}, {$phuongXa}, {$quanHuyen}, {$tinhThanh}";

            // Ánh xạ phương thức thanh toán
            $paymentMethodMapping = ['cod' => 1, 'vnpay' => 2];
            $maPhuongThuc = $paymentMethodMapping[$request->payment_method] ?? 1;

            // Tạo hóa đơn
            $hoadon = HoaDon::create([
                'MaKhachHang' => $request->khachhang_id,
                'NgayLap' => now(),
                'TongTien' => $request->total,
                'TrangThai' => 'Đang chờ',
                'PT_ThanhToan' => $maPhuongThuc,
                'DiaChi' => $diaChi,
                'SoDienThoai' => $request->so_dien_thoai,
                'GhiChu' => $request->ghi_chu,
            ]);

            // Tạo chi tiết hóa đơn
            $existingItems = [];
            foreach ($groupedCartItems as $item) {
                $bookId = $item['book']['MaSach'];
                if (isset($existingItems[$bookId])) {
                    Log::warning('Duplicate book detected in ChiTietHoaDon', [
                        'user_id' => $userId,
                        'MaSach' => $bookId,
                        'quantity' => $item['quantity'],
                    ]);
                    continue;
                }
                $existingItems[$bookId] = true;

                ChiTietHoaDon::create([
                    'MaHoaDon' => $hoadon->MaHoaDon,
                    'MaSach' => $item['book']['MaSach'],
                    'SoLuong' => $item['quantity'],
                    'DonGia' => $item['book']['GiaBan'],
                ]);
            }

            // Lưu địa chỉ nếu yêu cầu
            if ($request->has('save-address')) {
                DiaChiNhanHang::create([
                    'khachhang_id' => $request->khachhang_id,
                    'ten_nguoi_nhan' => $request->ten_nguoi_nhan,
                    'so_dien_thoai' => $request->so_dien_thoai,
                    'dia_chi_cu_the' => $request->dia_chi_cu_the,
                    'phuong_xa_id' => $request->phuong_xa_id,
                    'quan_huyen_id' => $request->quan_huyen_id,
                    'tinh_thanh_id' => $request->tinh_thanh_id,
                ]);
            }

            // // Làm sạch giỏ hàng và session                        
            // Session::forget(['groupedCartItems', 'promo']);

            // CartHold::where('user_id', $userId)->where('session_id', $sessionId)->delete();

            Log::info('Đặt hàng thành công', [
                'user_id' => $userId,
                'MaHoaDon' => $hoadon->MaHoaDon,
                'cart_details' => $cartDetails,
                'total' => $request->total,
            ]);

            return redirect()->route('account')->with('success', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi lưu đơn hàng: ' . $e->getMessage(), [
                'user_id' => $userId,
                'request' => $request->all(),
                'cart' => session('groupedCartItems', []),
                'trace' => $e->getTraceAsString(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi đặt hàng. Vui lòng thử lại.');
        }
    }
}
