<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::with('children')
            ->whereIn('parent_id', [1, 2]) // danh mục cấp 2
            ->get();

        $minPrice = Book::where('TrangThai', 1)->min('GiaBan') ?? 0;
        $maxPrice = Book::where('TrangThai', 1)->max('GiaBan') ?? 0;

        $query = Book::where('TrangThai', 1);

        // Tìm kiếm theo tên
        if ($request->filled('search')) {
            $query->where('TenSach', 'like', '%' . $request->search . '%');
        }

        // Lọc theo khoảng giá
        if ($request->filled('price_min') && $request->filled('price_max')) {
            $min = (int) $request->price_min;
            $max = (int) $request->price_max;
            if ($min <= $max) {
                $query->whereBetween('GiaBan', [$min, $max]);
            }
        }


        // Sắp xếp
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('GiaBan', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('GiaBan', 'desc');
                    break;
                case 'bestseller':
                    $query->orderBy('LuotMua', 'desc'); // giả sử có cột `LuotMua`
                    break;
            }
        }

        // Số lượng mỗi trang
        $perPage = $request->input('per_page', 12);
        
        $books = $query
            ->withCount(['reviews as reviews_count' => function ($query) {
                $query->where('TrangThai', 1);
            }])
            ->withAvg(['reviews as avg_rating' => function ($query) {
                $query->where('TrangThai', 1);
            }], 'SoSao')
            ->paginate($perPage)
            ->appends($request->query());

        return view('homepage.category', compact('categories', 'minPrice', 'maxPrice', 'books'));
    }
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $books = $category->books()->where('TrangThai', 1)->get();

        return view('homepage.categoryresult', compact('category', 'books'));
    }
}
