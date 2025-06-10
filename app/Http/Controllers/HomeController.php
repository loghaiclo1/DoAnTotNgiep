<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;

class HomeController extends Controller
{
    public function index()
    {
        $featuredBooks = Book::where('TrangThai', 1)->inRandomOrder()->take(3)->get();

        $dmcha = Category::whereNotNull('image')->get();

        $demDMcha = $dmcha->map(function ($dmcha) {
            $idDM = Category::where('parent_id', $dmcha->id)->pluck('id')->toArray();
            $dmcha->demsach = Book::whereIn('category_id', $idDM)->count();
            return $dmcha;
        });

        $books = Book::with('category')
            ->where('TrangThai', 1)
            ->inRandomOrder()
            ->take(8)
            ->get();

        $sachbanchay = Book::where('TrangThai', 1)
            ->orderBy('luotmua', 'desc')
            ->take(4)
            ->get();

        $filterCategories = $books->map(function ($book) {
            return $book->category->name ?? null;
        })->filter()->unique()->take(3);
        // Lấy danh mục cấp 2 thuộc cấp 1
        $dmCap2 = Category::where('parent_id', 1)->get();

        // Lấy danh mục cấp 3 thuộc cấp 2
        $dmCap3 = Category::whereIn('parent_id', $dmCap2->pluck('id')->toArray())->get();

        // Với mỗi dm cấp 3, đếm số sách
        $dmCap3 = $dmCap3->map(function ($dm) {
            $dm->book_count = Book::where('category_id', $dm->id)->count();
            return $dm;
        })->sortByDesc('book_count')->take(4)->values();

        return view('homepage.home', compact('demDMcha', 'books', 'filterCategories', 'featuredBooks', 'sachbanchay', 'dmCap2', 'dmCap3'));
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
