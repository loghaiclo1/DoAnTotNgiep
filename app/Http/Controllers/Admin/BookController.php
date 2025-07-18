<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\TacGia;
use App\Models\NhaXuatBan;
use App\Models\DonViPhatHanh;
use Illuminate\Validation\Rule;

class BookController extends Controller
{

    public function index(Request $request)
    {
        $query = $request->input('query');
        $sort = $request->input('sort', 'MaSach'); // mặc định sort theo id
        $direction = $request->input('direction', 'desc'); // mặc định mới nhất

        $categoryIds = (array) $request->input('category_id', []);
        $years = (array) $request->input('NamXuatBan', []);
        $statuses = (array) $request->input('TrangThai', []);

        $tacgias = TacGia::all();
        $nxb = NhaXuatBan::all();
        $donviphathanh = DonViPhatHanh::all();

        $books = Book::with('category', 'nhaxuatban', 'tacgia')
            ->when($query, function ($q) use ($query) {
                $nonAccentQuery = $this->removeAccents($query);
                $cleanedQuery = preg_replace('/[^0-9]/', '', $query); // loại bỏ ký tự không phải số

                $q->where(function ($q2) use ($query, $nonAccentQuery, $cleanedQuery) {
                    // Tìm theo tên sách hoặc mô tả gần đúng
                    $q2->where('TenSach', 'LIKE', "%$query%")
                        ->orWhere('MoTa', 'LIKE', "%$query%")
                        ->orWhereHas('tacgia', function ($sub) use ($query) {
                            $sub->where('TenTacGia', 'LIKE', "%$query%");
                        })
                        ->orWhereHas('nhaxuatban', function ($sub) use ($query) {
                            $sub->where('TenNXB', 'LIKE', "%$query%");
                        })
                        ->orWhereRaw("LOWER(REPLACE(REPLACE(REPLACE(TenSach, 'đ', 'd'), 'Đ', 'D'), ' ', '')) LIKE ?", [
                            '%' . str_replace(' ', '', strtolower($nonAccentQuery)) . '%'
                        ]);

                    // Tìm theo giá nếu người dùng nhập số
                    if (is_numeric($cleanedQuery)) {
                        $q2->orWhere('GiaBan', (int) $cleanedQuery);
                    }
                });
            })
            ->when(!empty($categoryIds), function ($q) use ($categoryIds) {
                $q->whereIn('category_id', $categoryIds);
            })
            ->when(!empty($years), function ($q) use ($years) {
                $q->whereIn('NamXuatBan', $years);
            })
            ->when(!empty($statuses), function ($q) use ($statuses) {
                $q->where(function ($query) use ($statuses) {
                    foreach ($statuses as $status) {
                        switch ($status) {
                            case 'in_stock':
                                $query->orWhere('SoLuong', '>', 0);
                                break;
                            case 'out_of_stock':
                                $query->orWhere('SoLuong', '=', 0);
                                break;
                            case 'active':
                                $query->orWhere('TrangThai', 1);
                                break;
                            case 'hidden':
                                $query->orWhere('TrangThai', 0);
                                break;
                        }
                    }
                });
            })
            ->when(in_array($sort, ['MaSach', 'GiaBan', 'SoLuong', 'created_at', 'LuotMua', 'NamXuatBan']), function ($q) use ($sort, $direction) {
                $q->orderBy($sort, $direction);
            })
            ->paginate(10)
            ->appends($request->all());

        $categories = Category::all();
        $years = Book::selectRaw('DISTINCT NamXuatBan')->orderBy('NamXuatBan', 'desc')->pluck('NamXuatBan');

        return view('admin.books', compact('books', 'categories', 'query', 'sort', 'direction', 'categoryIds', 'years', 'statuses', 'tacgias', 'nxb', 'donviphathanh'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'TenSach' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sach')->where(function ($query) use ($request) {
                    return $query->where('MaNXB', $request->MaNXB)
                        ->where('MaDVPH', $request->MaDVPH);
                }),
            ],
            'MaTacGia' => 'required|exists:tacgia,MaTacGia',
            'MaNXB' => 'required|exists:nhaxuatban,MaNXB',
            'MaDVPH' => 'nullable|exists:donviphathanh,MaDVPH',
            'GiaNhap' => 'required|numeric|min:1000',
            'GiaBan' => 'required|numeric|min:1000',
            'SoLuong' => 'required|integer|min:0',
            'NamXuatBan' => 'required|integer|min:2010|max:' . date('Y'),
            'category_id' => 'required|exists:danhmuc,id',
            'HinhAnh' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'MoTa' => 'nullable|string',
        ], [
            'TenSach.unique' => 'Sách này đã tồn tại với cùng nhà xuất bản và đơn vị phát hành.',
            'MaTacGia.required' => 'Vui lòng chọn tác giả.',
            'MaNXB.required' => 'Vui lòng chọn nhà xuất bản.',
            'category_id.required' => 'Vui lòng chọn danh mục.',
        ]);
        if ($data['GiaBan'] < $data['GiaNhap']) {
            return back()
                ->withInput()
                ->withErrors(['GiaBan' => 'Giá bán không được nhỏ hơn giá nhập.'])
                ->with('old_modal', 'add');
        }
        if ($request->hasFile('HinhAnh')) {
            $file = $request->file('HinhAnh');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('image/book'), $filename);
            $data['HinhAnh'] = $filename;
        }

        $data['slug'] = Str::slug($data['TenSach']);
        $data['TrangThai'] = 1;
        Book::create($data);


        return redirect()->route('admin.books.index')->with('success', 'Thêm sách thành công!');
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $data = $request->validate([
            'TenSach' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sach', 'TenSach')
                    ->ignore($book->MaSach, 'MaSach')
                    ->where(function ($query) use ($request) {
                        return $query->where('MaNXB', $request->MaNXB)
                            ->where('MaDVPH', $request->MaDVPH);
                    }),
            ],

            'MaTacGia' => 'required|exists:tacgia,MaTacGia',
            'MaNXB' => 'required|exists:nhaxuatban,MaNXB',
            'MaDVPH' => 'nullable|exists:donviphathanh,MaDVPH',
            'GiaNhap' => 'required|numeric|min:1000',
            'GiaBan' => 'required|numeric|min:1000',
            'SoLuong' => 'required|integer|min:0',
            'NamXuatBan' => 'required|integer|min:2010|max:' . date('Y'),
            'category_id' => 'required|exists:danhmuc,id',
            'HinhAnh' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'MoTa' => 'nullable|string',
        ], [
            'TenSach.unique' => 'Sách này đã tồn tại với cùng nhà xuất bản và đơn vị phát hành.',
        ]);
        if ($data['GiaBan'] < $data['GiaNhap']) {
            return back()
                ->withInput()
                ->withErrors(['GiaBan' => 'Giá bán không được nhỏ hơn giá nhập.'])
                ->with('old_modal', 'edit_' . $book->MaSach);
        }
        if ($request->hasFile('HinhAnh')) {
            $file = $request->file('HinhAnh');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('image/book'), $filename);
            $data['HinhAnh'] = $filename;
        }

        $data['slug'] = Str::slug($data['TenSach']);


        $oldPrice = $book->GiaBan;

        $book->update($data);

        if ($oldPrice != $data['GiaBan']) {
            event(new \App\Events\BookPriceUpdated(
                $book->MaSach,
                $book->TenSach,
                $oldPrice,
                $data['GiaBan']
            ));

            \Log::info('Giá sách đã thay đổi, phát sự kiện BookPriceUpdated', [
                'bookId' => $book->MaSach,
                'bookName' => $book->TenSach,
                'oldPrice' => $oldPrice,
                'newPrice' => $data['GiaBan']
            ]);
        }

        event(new \App\Events\BookQuantityUpdated($book->MaSach, $book->SoLuong));
        \Log::info('Event fired', [
            'bookId' => $book->MaSach,
            'quantity' => $book->SoLuong
        ]);

        return back()->with('success', 'Cập nhật sách thành công!');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->TrangThai = 0; // 0: đã bị ẩn / xóa mềm
        $book->save();

        return redirect()->route('admin.books.index')->with('success', 'Đã ẩn sách khỏi danh sách hiển thị!');
    }
    private function removeAccents($str)
    {
        $str = \Normalizer::normalize($str, \Normalizer::FORM_D);
        $str = preg_replace('/[\p{Mn}]/u', '', $str);
        $str = str_replace(['đ', 'Đ'], ['d', 'D'], $str);
        return $str;
    }
    public function restore($id)
    {
        $book = Book::findOrFail($id);
        $book->TrangThai = 1;
        $book->save();

        return redirect()->route('admin.books.index')->with('success', 'Đã khôi phục sách thành công!');
    }
    public function forceDelete($id)
    {
        $book = Book::findOrFail($id);

        if ($book->HinhAnh && file_exists(public_path('image/book/' . $book->HinhAnh))) {
            unlink(public_path('image/book/' . $book->HinhAnh));
        }

        $book->delete(); // Xóa luôn khỏi DB
        return redirect()->route('admin.books.index')->with('success', 'Đã xóa vĩnh viễn sách.');
    }
}
