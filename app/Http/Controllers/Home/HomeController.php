<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    public function index()
    {
        $featuredBooks = $this->getFeaturedBooks();
        $demDMcha = $this->getCategoryParentWithBookCount();
        $books = $this->getNewBooks();
        $sachbanchay = $this->getBestSellerBooks();
        $filterCategories = $this->getFilterCategories($books);
        $dmCap2 = $this->getDmCap2();
        $dmCap3 = $this->getDmCap3($dmCap2);

        $quotes = [
            'Mỗi cuốn sách là một người thầy im lặng.',
            'Đọc sách là cách trò chuyện với những bộ óc vĩ đại nhất.',
            'Sách mở rộng thế giới, ngay cả khi bạn đang ngồi yên.',
            'Tri thức là chìa khóa mở mọi cánh cửa thành công.',
            'Một ngày không đọc là một ngày lãng phí.'
        ];

        $randomQuote = $quotes[array_rand($quotes)];

        return view('homepage.home', compact(
            'demDMcha',
            'books',
            'filterCategories',
            'featuredBooks',
            'sachbanchay',
            'dmCap2',
            'dmCap3',
            'randomQuote'
        ));
    }
    private function getFeaturedBooks()
    {
        return Book::where('TrangThai', 1)
            ->where('SoLuong', '>', 0) // lọc sách còn hàng
            ->inRandomOrder()
            ->take(3)
            ->get();
    }
    private function getCategoryParentWithBookCount()
    {
        $dmcha = Category::whereNotNull('image')->get();

        return $dmcha->map(function ($dmcha) {
            $idDM = Category::where('parent_id', $dmcha->id)->pluck('id')->toArray();
            $dmcha->demsach = Book::whereIn('category_id', $idDM)->count();
            return $dmcha;
        });
    }

    private function getNewBooks()
    {
        return Book::with('category')
            ->where('TrangThai', 1)
            ->where('SoLuong', '>', 0)
            ->orderByDesc('created_at') // Ưu tiên sách mới nhất
            ->orderByDesc('MaSach')     // Nếu thời gian bằng nhau thì lấy sách có MaSach lớn hơn
            ->take(8)
            ->get();
    }
    private function getBestSellerBooks()
    {
        return Book::where('TrangThai', 1)
            ->where('SoLuong', '>', 0)
            ->withCount(['reviews as reviews_count' => function ($query) {
                $query->where('TrangThai', 1);
            }])
            ->withAvg(['reviews as avg_rating' => function ($query) {
                $query->where('TrangThai', 1);
            }], 'SoSao')
            ->orderByDesc('luotmua')
            ->take(4)
            ->get();
    }
    private function getFilterCategories($books)
    {
        return $books->map(function ($book) {
            return $book->category->name ?? null;
        })->filter()->unique()->take(3);
    }

    private function getDmCap2()
    {
        return Category::where('parent_id', 1)->get();
    }

private function getDmCap3($dmCap2)
{
    // Lấy danh sách ID của các danh mục cấp 2
    $dmCap2Ids = $dmCap2->pluck('id');

    // Lấy tất cả danh mục cấp 3 có parent_id nằm trong danh sách ID cấp 2
    return Category::whereIn('parent_id', $dmCap2Ids)->get()->groupBy('parent_id');
}


    public function about()
    {
        return view('homepage.about');
    }
    public function cart()
    {
        return view('homepage.cart');
    }
    public function category()
    {
        return view('homepage.category');
    }
    public function checkout()
    {
        return view('homepage.checkout');
    }
    public function contact()
    {
        return view('homepage.contact');
    }
    public function productdetail()
    {
        return view('homepage.productdetail');
    }
    public function search()
    {
        return view('homepage.search');
    }
    public function account()
    {
        return view('homepage.account');
    }
    public function login()
    {
        return view('homepage.login');
    }
    public function register()
    {
        return view('homepage.register');
    }
}
