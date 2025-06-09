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

        $categories = Category::whereNotNull('image')->get();

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
        return view('homepage.home', compact('categories', 'books', 'filterCategories', 'featuredBooks', 'sachbanchay'));
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
}
