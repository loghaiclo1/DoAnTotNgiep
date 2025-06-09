<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{


    public function productdetail($id)
    {
        $book = Book::where('MaSach', $id)->where('TrangThai', 1)->firstOrFail();

        return view('homepage.productdetail', compact('book'));
    }
}
