<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class UpdateCartTotalQuantity
{
    public function handle($request, Closure $next)
    {
        $cart = session('cart', []);
        $totalQuantity = 0;

        foreach ($cart as $item) {
            $totalQuantity += $item['quantity'];
        }

        session(['cart_total_quantity' => $totalQuantity]);

        return $next($request);
    }
}
