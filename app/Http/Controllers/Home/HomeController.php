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


        $sachbanchay = $this->getBestSellerBooks();
        $excludeBookIds = $sachbanchay->pluck('MaSach')->toArray();

        $sachGoiY = $this->getSuggestedBooks($excludeBookIds);
        $mergedBooks = $sachGoiY['group1']->merge($sachGoiY['group2'])
        ->unique('MaSach') // loại trùng
        ->take(6);       // lấy tối đa 6 cuốn
        return view('homepage.home', compact(
            'demDMcha',
            'books',
            'filterCategories',
            'featuredBooks',
            'sachbanchay',
            'dmCap2',
            'dmCap3',
            'randomQuote',
            'sachGoiY',
            'mergedBooks'
        ));
    }

    private function getFeaturedBooks()
    {
        return Book::where('TrangThai', 1)
            ->where('SoLuong', '>', 0)
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

    private function getNewBooks(array $excludeIds = [])
    {
        return Book::with('category')
            ->where('TrangThai', 1)
            ->where('SoLuong', '>', 0)
            ->when($excludeIds, fn($query) => $query->whereNotIn('MaSach', $excludeIds))
            ->orderByDesc('created_at')
            ->take(8)
            ->get();
    }

    private function getBestSellerBooks(array $excludeIds = [])
    {
        return Book::where('TrangThai', 1)
            ->where('SoLuong', '>', 0)
            ->when($excludeIds, fn($q) => $q->whereNotIn('MaSach', $excludeIds))
            ->orderByDesc('luotmua')
            ->take(4)
            ->get();
    }

    private function getFilterCategories($books)
    {
        return $books->map(fn($book) => $book->category->name ?? null)
            ->filter()
            ->unique()
            ->take(3);
    }

    private function getDmCap2()
    {
        return Category::where('parent_id', 1)->get();
    }

    private function getDmCap3($dmCap2)
    {
        $dmCap2Ids = $dmCap2->pluck('id');
        return Category::whereIn('parent_id', $dmCap2Ids)->get()->groupBy('parent_id');
    }

    /**
     *  Gợi ý sách chỉ cho tài khoản đã đăng nhập
     * - Đã đăng nhập + đã mua → cùng danh mục + cùng tác giả
     * -Đăng nhập chưa mua → bán chạy + bán chạy theo danh mục phổ biến

     */
    private function getSuggestedBooks(array $excludeBookIds = []): array
    {
        if (!auth()->check()) {

            return [
                'group1' => collect(),
                'group2' => collect()
            ];
        }

        $userId = auth()->id();


        $bookIds = \DB::table('hoadon')
            ->join('chitiethoadon', 'hoadon.MaHoaDon', '=', 'chitiethoadon.MaHoaDon')
            ->where('hoadon.MaKhachHang', $userId)
            ->pluck('chitiethoadon.MaSach')
            ->unique();

        if ($bookIds->isEmpty()) {

            return [
                'group1' => $this->getBestSellerBooks($excludeBookIds),
                'group2' => $this->getBestSellerInPopularCategories($excludeBookIds)
            ];
        }


        $categoryIds = Book::whereIn('MaSach', $bookIds)->pluck('category_id')->unique();
        $authorNames = Book::whereIn('MaSach', $bookIds)->pluck('TacGia')->filter()->unique();

        $group1 = Book::where('TrangThai', 1)
            ->where('SoLuong', '>', 0)
            ->whereIn('category_id', $categoryIds)
            ->whereNotIn('MaSach', $bookIds)
            ->inRandomOrder()
            ->take(4)
            ->get();

        $group2 = collect();
        if ($authorNames->isNotEmpty()) {
            $group2 = Book::where('TrangThai', 1)
                ->where('SoLuong', '>', 0)
                ->whereIn('TacGia', $authorNames)
                ->whereNotIn('MaSach', $bookIds)
                ->inRandomOrder()
                ->take(4)
                ->get();
        }

        return [
            'group1' => $group1,
            'group2' => $group2
        ];
    }


    private function getBestSellerInPopularCategories(array $excludeIds = [])
    {
        $popularCategoryIds = Book::select('category_id')
            ->where('TrangThai', 1)
            ->where('SoLuong', '>', 0)
            ->groupBy('category_id')
            ->orderByRaw('SUM(luotmua) DESC')
            ->limit(3)
            ->pluck('category_id');

        return Book::where('TrangThai', 1)
            ->where('SoLuong', '>', 0)
            ->whereIn('category_id', $popularCategoryIds)
            ->whereNotIn('MaSach', $excludeIds)
            ->orderByDesc('luotmua')
            ->take(4)
            ->get();
    }


    public function about()        { return view('homepage.about'); }
    public function cart()         { return view('homepage.cart'); }
    public function category()     { return view('homepage.category'); }
    public function checkout()     { return view('homepage.checkout'); }
    public function contact()      { return view('homepage.contact'); }
    public function productdetail(){ return view('homepage.productdetail'); }
    public function search()       { return view('homepage.search'); }
    public function account()      { return view('homepage.account'); }
    public function login()        { return view('homepage.login'); }
    public function register()     { return view('homepage.register'); }
}
