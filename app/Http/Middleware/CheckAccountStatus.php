<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAccountStatus
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->TrangThai == 0) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->withErrors(['account_locked' => 'Tài khoản của bạn đã bị khóa.']);
        }

        return $next($request);
    }
}
