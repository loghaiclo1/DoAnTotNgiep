<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\HoaDon;
use App\Models\ChiTietHoaDon;
use App\Models\CartHold;
use App\Models\DiaChiNhanHang;
use App\Models\TinhThanh;
use App\Models\QuanHuyen;
use App\Models\PhuongXa;
use App\Models\PendingOrder;

class VNPayController extends Controller
{
    protected $vnp_TmnCode = 'UHT37G31';
    protected $vnp_HashSecret = 'VM55SJSL703F15QIFPZ98E9RS2QJET5X';
    protected $vnp_Url = 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html';
    protected $vnp_Returnurl = 'http://localhost:8000/vnpay/return';

    public function createPayment(Request $request)
    {
        $total = $request->input('total');
        if (!$total || $total <= 0) {
            return response()->json(['message' => 'Tổng tiền không hợp lệ.'], 400);
        }

        $validated = $request->except('_token');
        $groupedCartItems = session('groupedCartItems', []);

        // Làm sạch dữ liệu giỏ hàng để tránh trùng lặp
        $cleanedCartItems = [];
        foreach ($groupedCartItems as $item) {
            $bookId = $item['book']['MaSach'];
            if (!isset($cleanedCartItems[$bookId])) {
                $cleanedCartItems[$bookId] = $item;
            } else {
                $cleanedCartItems[$bookId]['quantity'] += $item['quantity'];
            }
        }
        $groupedCartItems = array_values($cleanedCartItems);
        session(['groupedCartItems' => $groupedCartItems]);

        // Log dữ liệu giỏ hàng
        Log::info('Cleaned groupedCartItems before saving to PendingOrder', [
            'groupedCartItems' => $groupedCartItems,
            'total' => $total,
        ]);

        $vnp_TxnRef = uniqid();

        PendingOrder::create([
            'txn_ref'    => $vnp_TxnRef,
            'order_data' => json_encode($validated),
            'cart_data'  => json_encode($groupedCartItems),
        ]);

        // Chuẩn bị payload VNPay
        $amount = $total * 100;
        $inputData = [
            "vnp_Version"    => "2.1.0",
            "vnp_TmnCode"    => $this->vnp_TmnCode,
            "vnp_Amount"     => $amount,
            "vnp_Command"    => "pay",
            "vnp_CreateDate" => now()->format('YmdHis'),
            "vnp_CurrCode"   => "VND",
            "vnp_IpAddr"     => $request->ip(),
            "vnp_Locale"     => "vn",
            "vnp_OrderInfo"  => "Thanh toán đơn hàng Bookshop",
            "vnp_OrderType"  => "billpayment",
            "vnp_ReturnUrl"  => $this->vnp_Returnurl,
            "vnp_TxnRef"     => $vnp_TxnRef,
        ];
        ksort($inputData);

        $hashdata = '';
        foreach ($inputData as $key => $value) {
            $hashdata .= urlencode($key).'='.urlencode($value).'&';
        }
        $hashdata = rtrim($hashdata, '&');

        $inputData['vnp_SecureHash'] = hash_hmac('sha512', $hashdata, $this->vnp_HashSecret);

        // Redirect sang VNPay
        $vnpUrl = $this->vnp_Url . '?' . http_build_query($inputData);
        return redirect($vnpUrl);
    }

    public function paymentReturn(Request $request)
    {
        // Xác thực chữ ký
        $vnp_SecureHash = $request->input('vnp_SecureHash');
        $data = $request->except('vnp_SecureHash', 'vnp_SecureHashType');
        ksort($data);
        $hashdata = '';
        foreach ($data as $k => $v) {
            $hashdata .= urlencode($k).'='.urlencode($v).'&';
        }
        $hashdata = rtrim($hashdata, '&');

        if (hash_hmac('sha512', $hashdata, $this->vnp_HashSecret) !== $vnp_SecureHash) {
            return redirect()->route('checkout')->with('error', 'Dữ liệu thanh toán không hợp lệ.');
        }

        // Nếu thanh toán thành công
        if ($request->vnp_ResponseCode === '00') {
            $txnRef = $request->input('vnp_TxnRef');
            $pending = PendingOrder::where('txn_ref', $txnRef)->first();

            if (!$pending) {
                return redirect()->route('checkout')->with('error', 'Không tìm thấy đơn hàng để xử lý.');
            }

            $validated = json_decode($pending->order_data, true);
            $groupedCartItems = json_decode($pending->cart_data, true);

            // Log dữ liệu từ PendingOrder
            Log::info('PendingOrder data', [
                'txn_ref' => $txnRef,
                'validated' => $validated,
                'groupedCartItems' => $groupedCartItems,
            ]);

            // Kiểm tra tổng số lượng
            $totalQuantity = array_sum(array_column($groupedCartItems, 'quantity'));
            Log::info('Total quantity check', [
                'totalQuantity' => $totalQuantity,
                'groupedCartItems' => $groupedCartItems,
            ]);

            // Tự động đăng nhập lại user
            Auth::loginUsingId($validated['khachhang_id']);
            session()->regenerate();

            // Tạo hóa đơn chính
            $diaChi = sprintf(
                '%s, %s, %s, %s',
                $validated['dia_chi_cu_the'],
                PhuongXa::find($validated['phuong_xa_id'])->ten,
                QuanHuyen::find($validated['quan_huyen_id'])->ten,
                TinhThanh::find($validated['tinh_thanh_id'])->ten
            );

            $order = HoaDon::create([
                'MaKhachHang' => $validated['khachhang_id'],
                'NgayLap'     => now(),
                'TongTien'    => $validated['total'],
                'TrangThai'   => 'Đang chờ',
                'PT_ThanhToan'=> 2,
                'DiaChi'      => $diaChi,
                'SoDienThoai' => $validated['so_dien_thoai'],
                'GhiChu'      => $validated['ghi_chu'] ?? null,
            ]);

            // Ngăn trùng lặp sản phẩm khi tạo chi tiết hóa đơn
            $existingItems = [];
            foreach ($groupedCartItems as $item) {
                $bookId = $item['book']['MaSach'];
                if (isset($existingItems[$bookId])) {
                    Log::warning('Duplicate book detected', [
                        'MaSach' => $bookId,
                        'quantity' => $item['quantity'],
                    ]);
                    continue;
                }
                $existingItems[$bookId] = true;

                ChiTietHoaDon::create([
                    'MaHoaDon' => $order->MaHoaDon,
                    'MaSach'   => $bookId,
                    'SoLuong'  => $item['quantity'],
                    'DonGia'   => $item['book']['GiaBan'],
                ]);
            }

            // Lưu địa chỉ nếu cần
            if (!empty($validated['save-address'])) {
                DiaChiNhanHang::create([
                    'khachhang_id' => $validated['khachhang_id'],
                    'ten_nguoi_nhan' => $validated['ten_nguoi_nhan'],
                    'so_dien_thoai' => $validated['so_dien_thoai'],
                    'dia_chi_cu_the' => $validated['dia_chi_cu_the'],
                    'phuong_xa_id' => $validated['phuong_xa_id'],
                    'quan_huyen_id' => $validated['quan_huyen_id'],
                    'tinh_thanh_id' => $validated['tinh_thanh_id'],
                ]);
            }

            // Dọn dẹp
            $pending->delete();
            CartHold::where('user_id', $validated['khachhang_id'])->delete();
            session()->forget('groupedCartItems');

            // Redirect về account
            return redirect()->route('account')->with('success', 'Đặt hàng thành công qua VNPay!');
        }

        return redirect()->route('checkout')->with('error', 'Thanh toán VNPay thất bại!');
    }
}
