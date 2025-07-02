<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\DanhGiaSanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $reviews = $this->getReviews();

    if ($request->ajax()) {
    return response()->json([
        'html' => view('homepage.partials.review_list', compact('reviews'))->render(),
    ]);
}


    return view('homepage.account', compact('reviews', 'unreviewedBooks', 'addresses'));
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
    public function edit($id)
    {
        $review = DanhGiaSanPham::where('MaKhachHang', Auth::user()->MaKhachHang)
            ->where('MaDanhGia', $id)
            ->firstOrFail();

        return view('homepage.reviews.edit', compact('review'));
    }

public function update(Request $request, $id)
{
    try {
        $request->validate([
            'SoSao' => 'required|integer|min:1|max:5',
            'NoiDung' => 'required|string',
        ]);

        $review = DanhGiaSanPham::where('MaKhachHang', Auth::user()->MaKhachHang)
            ->where('MaDanhGia', $id)
            ->firstOrFail();

        $review->update([
            'SoSao' => $request->SoSao,
            'NoiDung' => $request->NoiDung,
            'NgayDanhGia' => now(),
        ]);

        $page = $request->input('page', 1);

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật đánh giá thành công.',
            'html' => view('homepage.partials.review_list', [
                'reviews' => $this->getReviews($page)
            ])->render(),
        ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Lỗi validate',
            'errors' => $e->errors(),
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ], 500);
    }
}


    public function destroy($id)
    {
        $review = DanhGiaSanPham::where('MaKhachHang', Auth::user()->MaKhachHang)
            ->where('MaDanhGia', $id)
            ->firstOrFail();

        $review->delete();

        return redirect()->route('account')->with('success', 'Xóa đánh giá thành công.');
    }
private function getReviews($page = 1)
{
    $reviews = DanhGiaSanPham::where('MaKhachHang', Auth::user()->MaKhachHang)
        ->with('Book')
        ->orderByDesc('NgayDanhGia')
        ->paginate(5, ['*'], 'page', $page);

$reviews->appends(['tab' => 'reviews']);

    return $reviews;
}



}
