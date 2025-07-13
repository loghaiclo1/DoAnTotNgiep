<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TacGia;
use App\Models\PhuongXa;
use App\Models\TinhThanh;
use App\Models\QuanHuyen;

class TacGiaController extends Controller
{
    public function index(Request $request)
    {
        $query = TacGia::withTrashed()
        ->with('xa.quanHuyen.tinhThanh')
        ->orderByRaw('CASE WHEN deleted_at IS NULL THEN 0 ELSE 1 END')
        ->orderByDesc('created_at');
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->whereNull('deleted_at');
            } elseif ($request->status === 'trashed') {
                $query->whereNotNull('deleted_at');
            }
        }
        if ($request->filled('q')) {
            $keyword = $request->q;

            $query->where(function ($q) use ($keyword) {
                $q->where('TenTacGia', 'like', '%' . $keyword . '%')
                  ->orWhere('nam_sinh', 'like', '%' . $keyword . '%')
                  ->orWhere('gioi_tinh', 'like', '%' . $keyword . '%')
                  ->orWhere('ghi_chu', 'like', '%' . $keyword . '%')
                  ->orWhereHas('xa', function ($subQ) use ($keyword) {
                      $subQ->where('ten', 'like', '%' . $keyword . '%')
                           ->orWhereHas('quanHuyen', function ($q2) use ($keyword) {
                               $q2->where('ten', 'like', '%' . $keyword . '%')
                                  ->orWhereHas('tinhThanh', function ($q3) use ($keyword) {
                                      $q3->where('ten', 'like', '%' . $keyword . '%');
                                  });
                           });
                  });
            });
        }

        $tacgias = $query->orderByDesc('created_at')->paginate(10);
        $phuongxas = PhuongXa::orderBy('ten')->get();
        $tinhs = TinhThanh::orderBy('ten')->get();
        $quanhuyens = QuanHuyen::orderBy('ten')->get();

        return view('admin.tacgia', compact('tacgias', 'phuongxas', 'tinhs', 'quanhuyens'));
    }


    public function create()
    {
        return view('admin.tacgia.create');
    }

    public function store(Request $request)
    {
        if ($request->isQuick) {
            $validated = $request->validate([
                'TenTacGia' => 'required|string|max:255',
                'nam_sinh' => 'required|integer|between:1000,2010',
            ]);

            $tacgia = TacGia::create([
                'TenTacGia' => $validated['TenTacGia'],
                'nam_sinh' => $validated['nam_sinh'],
            ]);

            return response()->json([
                'success' => true,
                'tacgia' => $tacgia
            ]);
        }

        $request->validate([
            'TenTacGia' => 'required|string|max:255',
            'nam_sinh' => [
                'nullable',
                'integer',
                'between:1000,2010',
            ],
            'que_quan_id' => 'nullable|exists:phuongxa,id',
            'ghi_chu' => 'nullable|string',
        ], [
            'nam_sinh.between' => 'Năm sinh phải từ 1000 đến 2010',
        ]);

        TacGia::create($request->only('TenTacGia', 'nam_sinh', 'que_quan_id', 'ghi_chu'));

        return redirect()->route('admin.tacgia.index')->with('success', 'Thêm tác giả thành công!');
    }

    public function getDiaChiFromXa($id)
    {
        $xa = PhuongXa::with('quanHuyen.tinhThanh')->find($id);

        if (!$xa || !$xa->quanHuyen || !$xa->quanHuyen->tinhThanh) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy địa chỉ']);
        }

        return response()->json([
            'success' => true,
            'xa' => [
                'id' => $xa->id,
                'ten' => $xa->ten
            ],
            'huyen' => [
                'id' => $xa->quanHuyen->id,
                'ten' => $xa->quanHuyen->ten
            ],
            'tinh' => [
                'id' => $xa->quanHuyen->tinhThanh->id,
                'ten' => $xa->quanHuyen->tinhThanh->ten
            ]
        ]);
    }

    public function edit($id)
    {
        $tacgia = TacGia::find($id);

        if (!$tacgia) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy tác giả']);
        }

        $xa = optional($tacgia->xa)->ten;
        $huyen = optional($tacgia->xa->quanHuyen ?? null)->ten;
        $tinh = optional($tacgia->xa->quanHuyen->tinhThanh ?? null)->ten;

        $tacgia->que_quan_text = collect([$xa, $huyen, $tinh])->filter()->implode(', ') ?: 'Chưa có';

        return response()->json([
            'success' => true,
            'tacgia' => $tacgia
        ]);
    }


    public function update(Request $request, $id)
    {
        $currentYear = now()->year;
        $validator = \Validator::make($request->all(), [
            'TenTacGia' => 'required|string|max:255',
            'nam_sinh' => [
                'nullable',
                'integer',
                'between:1000, 2010',
            ],
            'que_quan_id' => 'nullable|exists:phuongxa,id',
            'ghi_chu' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            $editData = (object) $request->only(['TenTacGia', 'nam_sinh', 'que_quan_id', 'ghi_chu']);
            $editData->MaTacGia = $id;

            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('edit_open', $id)
                ->with('edit_data', $editData);
        }

        $tacgia = TacGia::findOrFail($id);
        $tacgia->update($request->only('TenTacGia', 'nam_sinh', 'que_quan_id', 'ghi_chu'));

        return redirect()->route('admin.tacgia.index')
            ->with('success', 'Cập nhật tác giả thành công!');
    }

    public function quickAdd(Request $request)
    {
        $request->validate([
            'TenTacGia' => 'required|string|max:255',
            'NamSinh' => 'required|integer|min:1920|max:' . (date('Y') - 20),
        ]);

        $tacgia = TacGia::create([
            'TenTacGia' => $request->TenTacGia,
            'nam_sinh' => $request->NamSinh,
        ]);

        return response()->json([
            'success' => true,
            'tacgia' => [
                'MaTacGia' => $tacgia->MaTacGia,
                'TenTacGia' => $tacgia->TenTacGia,
                'nam_sinh' => $tacgia->nam_sinh,
                'ghi_chu' => $tacgia->ghi_chu,
                'que_quan_text' => optional($tacgia->quequan)->ten,
            ]
        ]);
    }


    public function show($id)
    {
        $tacgia = TacGia::findOrFail($id);
        return response()->json($tacgia);
    }
    public function books($id, Request $request)
    {
        $tacgia = TacGia::with('sach')->findOrFail($id);

        $booksQuery = $tacgia->sach()->with('category')->where('TrangThai', 1);

        // Tìm kiếm theo tên sách
        if ($request->filled('search')) {
            $booksQuery->where('TenSach', 'like', '%' . $request->search . '%');
        }

        // Lọc theo trạng thái
        if ($request->filled('status')) {
            if ($request->status == 'con') {
                $booksQuery->where('SoLuong', '>', 0);
            } elseif ($request->status == 'het') {
                $booksQuery->where('SoLuong', '=', 0);
            }
        }

        $books = $booksQuery->paginate(10);

        return view('admin.tacgia.books', compact('tacgia', 'books'));
    }
    public function restore($id)
    {
        $tacgia = TacGia::withTrashed()->findOrFail($id);
        $tacgia->restore();

        return redirect()->route('admin.tacgia.index')->with('success', 'Khôi phục tác giả thành công!');
    }
    public function destroy($id)
    {
        TacGia::findOrFail($id)->delete();
        return redirect()->route('admin.tacgia.index')->with('success', 'Xóa tác giả thành công!');
    }
}
