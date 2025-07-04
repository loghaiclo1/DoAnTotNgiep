<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $sort = $request->input('sort', 'MaSach'); // mặc định sort theo id
        $direction = $request->input('direction', 'desc'); // mới nhất

        $categoryIds = (array) $request->input('category_id', []);
        $years = (array) $request->input('NamXuatBan', []);
        $statuses = (array) $request->input('TrangThai', []);
        $books = Book::with('category')
            ->when($query, function ($q) use ($query) {
                $nonAccentQuery = $this->removeAccents($query);
                $q->where(function ($q2) use ($query, $nonAccentQuery) {
                    $q2->where('TenSach', 'LIKE', "%$query%")
                       ->orWhere('MoTa', 'LIKE', "%$query%")
                       ->orWhereRaw("LOWER(REPLACE(TenSach, 'đ', 'd')) LIKE ?", ["%$nonAccentQuery%"]);
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
                    if (in_array('0', $statuses)) {
                        $query->orWhere('SoLuong', '=', 0); // Hết hàng
                    }
                    if (in_array('1', $statuses)) {
                        $query->orWhere('SoLuong', '>', 0); // Còn hàng
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

        return view('admin.books', compact('books', 'categories', 'query', 'sort', 'direction', 'categoryIds', 'years', 'statuses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'TenSach' => 'required|string|max:255|unique:sach,TenSach',

            'GiaNhap' => 'required|numeric|min:1000',
            'GiaBan' => 'required|numeric|min:1000',
            'SoLuong' => 'required|integer|min:0',
            'NamXuatBan' => 'required|integer|min:2010|max:' . date('Y'),
            'category_id' => 'required|exists:danhmuc,id',
            'HinhAnh' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'MoTa' => 'nullable|string',
        ]);

        if ($request->hasFile('HinhAnh')) {
            $file = $request->file('HinhAnh');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('image/book'), $filename);
            $data['HinhAnh'] = $filename;
        }

        $data['slug'] = Str::slug($data['TenSach']);
        Book::create($data);

        return redirect()->route('admin.books.index')->with('success', 'Thêm sách thành công!');
    }


    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $data = $request->validate([
            'TenSach' => 'required|string|max:255|unique:sach,TenSach,' . $book->MaSach . ',MaSach',
            'GiaNhap' => 'required|numeric|min:1000',
            'GiaBan' => 'required|numeric|min:1000',
            'SoLuong' => 'required|integer|min:0',
            'NamXuatBan' => 'required|integer|min:2010|max:' . date('Y'),
            'category_id' => 'required|exists:danhmuc,id',
            'HinhAnh' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'MoTa' => 'nullable|string',
        ]);
        if ($request->hasFile('HinhAnh')) {
            $file = $request->file('HinhAnh');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('image/book'), $filename);
            $data['HinhAnh'] = $filename;
        }

        $data['slug'] = Str::slug($data['TenSach']);
        $book->update($data);
        event(new \App\Events\BookQuantityUpdated($book->MaSach, $book->SoLuong));
        \Log::info('Event fired', [
            'bookId' => $book->MaSach,
            'quantity' => $book->SoLuong
        ]);
        return redirect()->route('admin.books.index')->with('success', 'Cập nhật sách thành công!');
    }

    public function destroy($id)
    {
        Book::destroy($id);
        return redirect()->route('admin.books.index')->with('success', 'Xóa sách thành công!');
    }

    private function removeAccents($str)
    {
        $str = \Normalizer::normalize($str, \Normalizer::FORM_D);
        $str = preg_replace('/[\p{Mn}]/u', '', $str);
        $str = str_replace(['đ', 'Đ'], ['d', 'D'], $str);
        return $str;
    }
}
