<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Hoadon;
use App\Models\Book;
use Illuminate\Support\Facades\Log;

class AccountController extends Controller
{
    public function index()
    {
        $user = auth::user();
        $orders = HoaDon::with(['chitiethoadon.sach', 'phuongthucthanhtoan'])
            ->where('MaKhachHang', $user->MaKhachHang)
            ->orderByDesc('NgayLap')
            ->get();

        $addresses = $user->addresses; // Thêm dòng này
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
        return view('homepage.account', compact('user', 'orders', 'addresses'));
    }
}
