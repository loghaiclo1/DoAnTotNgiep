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
        $books = Book::with(['tacgia', 'nhaxuatban'])->get();
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
            'books.*.GiaBan' => 'required|numeric|min:1000',
        ]);

        // Kiểm tra lỗi trước khi lưu
        $errors = [];
        foreach ($request->books as $item) {
            $book = \App\Models\Book::find($item['MaSach']);
            if ($item['GiaBan'] < $item['DonGia']) {
                $errors[] = 'Không thể nhập sách có giá bán nhỏ hơn giá nhập:
                Sách "' . ($book->TenSach ?? 'Không rõ') . '" có giá bán (' . number_format($item['GiaBan']) . '₫) nhỏ hơn giá nhập (' . number_format($item['DonGia']) . '₫).';
            }
        }

        if (!empty($errors)) {
            return back()->withInput()->withErrors($errors);
        }

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

                // Cập nhật tồn kho và giá sách
                $book = Book::find($item['MaSach']);
                $book->SoLuong += $item['SoLuong'];
                $book->GiaNhap = $item['DonGia'];
                $book->GiaBan = $item['GiaBan'];
                $book->save();
            }

            DB::commit();
            return redirect()->route('admin.phieunhap.create')->with('success', 'Tạo phiếu nhập thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['Lỗi hệ thống: ' . $e->getMessage()]);
        }
    }


    public function index(Request $request)
    {
        $query = PhieuNhap::query()
            ->join('khachhang', 'phieunhap.MaKhachHang', '=', 'khachhang.MaKhachHang')
            ->leftJoin('chitietphieunhap', 'phieunhap.MaPhieuNhap', '=', 'chitietphieunhap.MaPhieuNhap')
            ->leftJoin('sach', 'chitietphieunhap.MaSach', '=', 'sach.MaSach')
            ->select('phieunhap.*', 'khachhang.Ho', 'khachhang.Ten');

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('phieunhap.MaPhieuNhap', 'like', "%$keyword%")
                  ->orWhere('phieunhap.GhiChu', 'like', "%$keyword%")
                  ->orWhere(DB::raw("CONCAT(khachhang.Ho, ' ', khachhang.Ten)"), 'like', "%$keyword%")
                  ->orWhere('phieunhap.NgayNhap', 'like', "%$keyword%")
                  ->orWhere('sach.TenSach', 'like', "%$keyword%"); //  tìm theo tên sách
            });
        }

        $phieuNhaps = $query->orderByDesc('phieunhap.NgayNhap')->paginate(10)->appends($request->all());

        return view('admin.phieunhap.index', compact('phieuNhaps'));
    }


public function show($id)
{
    $phieuNhap = PhieuNhap::with(['chi_tiet.sach', 'nguoi_nhap'])->findOrFail($id);
    return view('admin.phieunhap.show', compact('phieuNhap'));
}
public function edit($id)
{
    $phieuNhap = PhieuNhap::with('chi_tiet')->findOrFail($id);
    $books = Book::with(['tacgia', 'nhaxuatban'])->get();

    return view('admin.phieunhap.edit', compact('phieuNhap', 'books'));
}
public function update(Request $request, $id)
{
    $books = $request->books;

    // Nếu không còn sách nào được gửi lên (người dùng xoá hết sách)
    if (!is_array($books) || empty($books)) {
        $phieuNhap = PhieuNhap::findOrFail($id);

        // Trả lại tồn kho cũ
        foreach ($phieuNhap->chi_tiet as $oldDetail) {
            $book = Book::find($oldDetail->MaSach);
            if ($book) {
                $book->SoLuong -= $oldDetail->SoLuong;
                $book->save();
            }
        }

        // Xoá chi tiết cũ
        ChiTietPhieuNhap::where('MaPhieuNhap', $phieuNhap->MaPhieuNhap)->delete();

        // Cập nhật ghi chú
        $phieuNhap->GhiChu = $request->GhiChu;
        $phieuNhap->save();

        return redirect()->route('admin.phieunhap.index')->with('success', 'Đã cập nhật phiếu nhập (không còn sách nào).');
    }

    // Nếu có sách → tiếp tục validate như cũ
    $request->validate([
        'GhiChu' => 'nullable|string',
        'books.*.MaSach' => 'required|exists:sach,MaSach',
        'books.*.SoLuong' => 'required|integer|min:1',
        'books.*.DonGia' => 'required|numeric|min:1000',
        'books.*.GiaBan' => 'required|numeric|min:1000',
    ]);

    $errors = [];
    foreach ($books as $item) {
        $book = Book::find($item['MaSach']);
        if ($item['GiaBan'] < $item['DonGia']) {
            $errors[] = 'Không thể nhập sách có giá bán nhỏ hơn giá nhập: "' . ($book->TenSach ?? 'Không rõ') . '"';
        }
    }

    if (!empty($errors)) {
        return back()->withInput()->withErrors($errors);
    }

    DB::beginTransaction();
    try {
        $phieuNhap = PhieuNhap::findOrFail($id);

        // Trả lại tồn kho cũ
        foreach ($phieuNhap->chi_tiet as $oldDetail) {
            $book = Book::find($oldDetail->MaSach);
            if ($book) {
                $book->SoLuong -= $oldDetail->SoLuong;
                $book->save();
            }
        }

        // Xoá chi tiết cũ
        ChiTietPhieuNhap::where('MaPhieuNhap', $phieuNhap->MaPhieuNhap)->delete();

        // Cập nhật ghi chú
        $phieuNhap->GhiChu = $request->GhiChu;
        $phieuNhap->save();

        // Lưu chi tiết mới và cập nhật sách
        foreach ($books as $item) {
            ChiTietPhieuNhap::create([
                'MaPhieuNhap' => $phieuNhap->MaPhieuNhap,
                'MaSach' => $item['MaSach'],
                'SoLuong' => $item['SoLuong'],
                'DonGia' => $item['DonGia'],
            ]);

            $book = Book::find($item['MaSach']);
            $book->SoLuong += $item['SoLuong'];
            $book->GiaNhap = $item['DonGia'];
            $book->GiaBan = $item['GiaBan'];
            $book->save();
        }

        DB::commit();
        return redirect()->route('admin.phieunhap.index')->with('success', 'Cập nhật phiếu nhập thành công!');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withInput()->withErrors(['Lỗi hệ thống: ' . $e->getMessage()]);
    }
}

}
