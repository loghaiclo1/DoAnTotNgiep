<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function productdetail($slug)
    {
        $book = Book::where('slug', $slug)->where('TrangThai', 1)->firstOrFail();

        return view('homepage.productdetail', compact('book'));
    }
}
