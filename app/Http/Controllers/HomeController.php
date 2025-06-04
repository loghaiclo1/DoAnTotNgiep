<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('homepage.home');
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
