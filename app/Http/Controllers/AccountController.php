<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Hoadon;
use App\Models\Book;

class AccountController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $orders = HoaDon::with(['chitiethoadon.sach', 'phuongthucthanhtoan'])
            ->where('MaKhachHang', $user->MaKhachHang)
            ->orderByDesc('NgayLap')
            ->get();

        $addresses = $user->addresses; // Thêm dòng này

        return view('homepage.account', compact('user', 'orders', 'addresses'));
    }


}
