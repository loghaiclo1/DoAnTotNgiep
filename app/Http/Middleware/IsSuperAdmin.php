<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsSuperAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'superadmin') {
            return $next($request);
        }

        return redirect()->back()->with('error', 'Bạn không có quyền truy cập trang này.');
    }
}
