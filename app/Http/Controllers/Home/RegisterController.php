<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\KhachHang;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function show()
    {
        return view('homepage.register');
    }

    public function register(RegisterRequest $request)
    {
        $khachhang = new KhachHang();
        $khachhang->Ho = $request->ho;
        $khachhang->Ten = $request->ten;
        $khachhang->Email = $request->email;
        $khachhang->MatKhau = Hash::make($request->matkhau);
        $khachhang->TrangThai = 1;
        $khachhang->created_at = now();
        $khachhang->save();

        return redirect()->route('register')->with('register_success', true);

    }

}
