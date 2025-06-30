<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
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

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $user = Auth::user();
            $message = 'Đăng nhập thành công.<br>Chào mừng ' . $user->Ho . ' ' . $user->Ten . ' đến với trang web.';

            // Gộp giỏ hàng (nếu có)
            $cartController = new \App\Http\Controllers\Home\CartController();
            $cartController->mergeCart();

            // ✅ Check role: nếu là admin thì redirect /admin
            if ($user->role === 'admin') {
                return redirect('/admin')->with('success', $message);
            }

            // ✅ Người dùng thường: về trang trước hoặc / nếu không có
            $returnUrl = $request->input('returnUrl', '/');
            if (!in_array($returnUrl, ['/cart', '/'])) {
                $returnUrl = '/';
            }

            return redirect($returnUrl)->with('success', $message);
        }

        // Nếu đăng nhập sai
        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Đăng xuất thành công.');
    }
}
