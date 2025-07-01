<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\DanhGiaSanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = DanhGiaSanPham::with(['book'])
            ->where('MaKhachHang', Auth::user()->MaKhachHang)
            ->orderByDesc('NgayDanhGia')
            ->get();

        return view('account.my-reviews', compact('reviews'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'MaSach' => 'required|exists:sach,MaSach',
            'SoSao' => 'required|integer|min:1|max:5',
            'NoiDung' => 'required|string',
        ]);

        DanhGiaSanPham::create([
            'MaHoaDon' => null, // Nếu không cần ràng buộc hóa đơn
            'MaKhachHang' => Auth::user()->MaKhachHang,
            'MaSach' => $request->MaSach,
            'NoiDung' => $request->NoiDung,
            'SoSao' => $request->SoSao,
            'NgayDanhGia' => now(),
            'TrangThai' => 1, // Tự động duyệt hoặc chờ admin duyệt tùy bạn
        ]);

        return back()->with('success', 'Đánh giá đã được gửi thành công.');
    }
    public function create(Request $request)
    {
        $maSach = $request->query('MaSach');

        // Lấy thông tin sách để hiển thị form
        $book = Book::findOrFail($maSach);

        return view('homepage.reviews.create', compact('book'));
    }
}
