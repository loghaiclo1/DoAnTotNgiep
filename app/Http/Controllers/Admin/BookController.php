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
        $direction = $request->input('direction', 'desc'); // mặc định mới nhất

        $categoryIds = (array) $request->input('category_id', []);
        $years = (array) $request->input('NamXuatBan', []);
        $statuses = (array) $request->input('TrangThai', []);

        $books = Book::with('category')
            ->when($query, function ($q) use ($query) {
                $nonAccentQuery = $this->removeAccents($query);
                $cleanedQuery = preg_replace('/[^0-9]/', '', $query); // loại bỏ ký tự không phải số

                $q->where(function ($q2) use ($query, $nonAccentQuery, $cleanedQuery) {
                    // Tìm theo tên sách hoặc mô tả gần đúng
                    $q2->where('TenSach', 'LIKE', "%$query%")
                        ->orWhere('MoTa', 'LIKE', "%$query%")
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
