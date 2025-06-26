<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Hoadon;
use App\Models\Book;
use Illuminate\Support\Facades\Log;
use App\Models\TinhThanh;
use App\Models\QuanHuyen;
use App\Models\PhuongXa;
class AccountController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $addresses = $user->addresses ?? collect();
        $orders = HoaDon::with(['chitiethoadon.sach', 'phuongthucthanhtoan'])
            ->where('MaKhachHang', $user->MaKhachHang)
            ->orderByDesc('NgayLap')
            ->get();

        $addresses = $user->addresses;
        $tinhThanhs = TinhThanh::all();

        // Log chi tiết đơn hàng (tuỳ chọn debug)
        foreach ($orders as $order) {
            foreach ($order->chitiethoadon as $item) {
                Log::info("Chi tiết đơn {$order->MaHoaDon}", [
                    'MaSach' => $item->MaSach,
                    'TenSach' => optional($item->sach)->TenSach,
                    'DonGia' => $item->DonGia,
                    'SoLuong' => $item->SoLuong,
                ]);
            }
        }

        return view('homepage.account', compact('user', 'orders', 'addresses', 'tinhThanhs'));
    }
    public function getOrderStatus($id)
{
    $order = HoaDon::find($id);

    if (!$order) {
        return response()->json(['status' => 'not_found'], 404);
    }

    $statusMap = [
        'Đang chờ' => 'processing',
        'Đã xác nhận' => 'confirmed',
        'Đang giao' => 'shipping',
        'Hoàn tất' => 'completed',
        'Đã hủy' => 'cancelled',
    ];

    return response()->json([
        'status' => $order->TrangThai,
        'class' => $statusMap[$order->TrangThai] ?? 'processing'
    ]);
}

}
