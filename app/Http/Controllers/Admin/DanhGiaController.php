<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DanhGiaSanPham;
use App\Events\ReviewApproved;
class DanhGiaController extends Controller
{
    public function index(Request $request)
    {
        $query = DanhGiaSanPham::with(['book', 'user']);

        if ($request->filled('status')) {
            $statusMap = [
                'pending' => 0,
                'approved' => 1,
                'rejected' => 2
            ];
            if (isset($statusMap[$request->status])) {
                $query->where('TrangThai', $statusMap[$request->status]);
            }
        }
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('NoiDung', 'like', '%' . $keyword . '%')
                  ->orWhereHas('book', function ($sub) use ($keyword) {
                      $sub->where('TenSach', 'like', '%' . $keyword . '%');
                  });
            });
        }
        if ($request->filled('sosao')) {
            $query->where('SoSao', $request->sosao);
        }

        // Lấy thống kê số lượng theo sao
        $starsCount = DanhGiaSanPham::select('SoSao', \DB::raw('count(*) as count'))
            ->groupBy('SoSao')
            ->pluck('count', 'SoSao');

        $reviews = $query->orderByDesc('MaDanhGia')->paginate(10);

        return view('admin.review', compact('reviews', 'starsCount'));
    }

    public function approve($id)
    {
        $review = DanhGiaSanPham::with(['book', 'user'])->findOrFail($id);
        $review->update(['TrangThai' => 1]);
        event(new ReviewApproved($review));
        return back()->with('success', 'Đánh giá đã được duyệt.');
    }
    public function reject($id)
    {
        DanhGiaSanPham::where('MaDanhGia', $id)->update(['TrangThai' => 2]);
        return back()->with('success', 'Đánh giá đã bị ẩn.');
    }
    public function destroy($id)
    {
        DanhGiaSanPham::where('MaDanhGia', $id)->delete();
        return back()->with('success', 'Đánh giá đã được xóa.');
    }
}
