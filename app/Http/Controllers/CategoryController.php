<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $books = $category->books()->where('TrangThai', 1)->get();

        return view('homepage.categoryresult', compact('category', 'books'));
    }
}
