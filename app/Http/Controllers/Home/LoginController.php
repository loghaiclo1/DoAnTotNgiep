<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\KhachHang;

class LoginController extends Controller
{
    use AuthenticatesUsers, ThrottlesLogins;

    public function username()
    {
        return 'email';
    }

    public function showLoginForm()
    {
        return view('homepage.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            $seconds = $this->limiter()->availableIn(
                $this->throttleKey($request)
            );

            return back()->withErrors(['email' => 'Bạn đã đăng nhập quá nhiều lần. Vui lòng thử lại sau ' . $seconds . ' giây ',]);
        }

        $credentials = $request->only('email', 'password');

        $this->incrementLoginAttempts($request);


        // Tìm user theo email
        $user = KhachHang::where('email', $credentials['email'])->first();

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

            $this->clearLoginAttempts($request);

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

    protected function throttleKey(Request $request)
    {
        return strtolower($request->input($this->username())) . '|' . $request->ip();
    }

    protected function decayMinutes()
    {
        return 1; // Thời gian khóa sau khi quá nhiều lần đăng nhập
    }

    protected function maxAttempts()
    {
        return 5; // Số lần đăng nhập tối đa trước khi bị khóa
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
