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

        // Tìm user theo email
        $user = \App\Models\KhachHang::where('email', $credentials['email'])->first();

        // Nếu không tồn tại
        if (!$user) {
            return back()->withErrors(['email' => 'Email không tồn tại.'])->withInput();
        }

        // Nếu tài khoản bị khóa
        if ($user->TrangThai == 0) {
            return back()->withErrors(['email' => 'Tài khoản đã bị khóa.'])->withInput();
        }

        // Tiếp tục đăng nhập nếu mọi thứ hợp lệ
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $user = Auth::user();
            $user->update(['last_login_at' => now()]); // Cập nhật thời gian đăng nhập cuối

            $message = 'Đăng nhập thành công.<br>Chào mừng ' . $user->Ho . ' ' . $user->Ten . ' đến với trang web.';

            // Gộp giỏ hàng
            $cartController = new \App\Http\Controllers\Home\CartController();
            $cartController->mergeCart();

            if ($user->role === 'admin') {
                return redirect('/admin')->with('success', $message);
            }

            $returnUrl = $request->input('returnUrl', '/');
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

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Đã logout']);
        }

        return redirect('/login');
    }
}
