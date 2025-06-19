<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('homepage.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $message = 'Đăng nhập thành công.<br>Chào mừng ' . $user->Ho . ' ' . $user->Ten . ' đến với trang web.';

            // Gọi hàm mergeCart từ CartController
            $cartController = new \App\Http\Controllers\CartController();
            $cartController->mergeCart();

            // Lấy returnUrl từ request (được gửi từ client-side)
            $returnUrl = $request->input('returnUrl', '/');

            // Kiểm tra xem returnUrl có hợp lệ không (chỉ cho phép /cart hoặc /)
            if (!in_array($returnUrl, ['/cart', '/'])) {
                $returnUrl = '/';
            }

            return redirect($returnUrl)->with('success', $message);
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
