<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Footer;

class FooterClientController extends Controller
{
    // Hiển thị nội dung điều khoản theo slug
    public function show($slug)
    {

        $footer = Footer::where('duong_dan', '/' . $slug)->firstOrFail();

        return view('homepage.footer_detail', compact('footer'));
    }
}
