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

        if (!$user) {
            return back()->withErrors(['email' => 'Email không tồn tại.'])->withInput();
        }

        // Duy nhất 1 lần attempt
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $user = Auth::user();

            if ($user->TrangThai == 0) {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Tài khoản của bạn đã bị khóa.');
            }
    
            $user->update(['last_login_at' => now()]);

            // Gộp giỏ hàng
            (new \App\Http\Controllers\Home\CartController())->mergeCart();

            $message = 'Đăng nhập thành công.<br>Chào mừng ' . $user->Ho . ' ' . $user->Ten . ' đến với trang web.';

            if (in_array($user->role, ['admin', 'superadmin'])) {
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
