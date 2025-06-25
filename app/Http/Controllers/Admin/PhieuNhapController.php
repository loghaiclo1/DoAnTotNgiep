<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhieuNhap;
use App\Models\ChiTietPhieuNhap;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhieuNhapController extends Controller
{
    public function create()
    {
        $books = Book::all();
        return view('admin.phieunhap.create', compact('books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'MaKhachHang' => 'nullable|exists:khachhang,MaKhachHang',
            'GhiChu' => 'nullable|string',
            'books.*.MaSach' => 'required|exists:sach,MaSach',
            'books.*.SoLuong' => 'required|integer|min:1',
            'books.*.DonGia' => 'required|numeric|min:1000',
        ]);

        DB::beginTransaction();
        try {
            $phieuNhap = PhieuNhap::create([
                'MaKhachHang' => auth()->id(),
                'GhiChu' => $request->GhiChu,
                'NgayNhap' => now(),
            ]);

            foreach ($request->books as $item) {
                ChiTietPhieuNhap::create([
                    'MaPhieuNhap' => $phieuNhap->MaPhieuNhap,
                    'MaSach' => $item['MaSach'],
                    'SoLuong' => $item['SoLuong'],
                    'DonGia' => $item['DonGia'],
                ]);

                // Cộng thêm số lượng vào sách hiện có
                Book::where('MaSach', $item['MaSach'])->increment('SoLuong', $item['SoLuong']);
            }

            DB::commit();
            return redirect()->route('admin.phieunhap.create')->with('success', 'Tạo phiếu nhập thành công!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Lỗi: ' . $e->getMessage()]);
        }
    }
    public function index()
{
    $phieuNhaps = PhieuNhap::with('nguoi_nhap')->orderByDesc('NgayNhap')->get();
    return view('admin.phieunhap.index', compact('phieuNhaps'));
}

public function show($id)
{
    $phieuNhap = PhieuNhap::with(['chi_tiet.sach', 'nguoi_nhap'])->findOrFail($id);
    return view('admin.phieunhap.show', compact('phieuNhap'));
}
}
