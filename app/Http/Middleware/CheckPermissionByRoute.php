<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;



class CheckPermissionByRoute
{

    public function handle(Request $request, Closure $next)
    {

        $user = Auth::user();
        if (!$user) {
            abort(403);
        }
        if ($user->isSuperAdmin() || $user->hasPermissionTo('full access')) {
            return $next($request);
        }


        // Ánh xạ tên route → quyền cần có
        $permissionsMap = [
            // Book
            'admin.books.store'         => 'create books',
            'admin.books.update'        => 'edit books',
            'admin.books.destroy'       => 'delete books',
            'admin.books.restore'       => 'restore books',
            'admin.books.forceDelete'   => 'force delete books',

            // Category
            'admin.categories.store'    => 'create categories',
            'admin.categories.update'   => 'edit categories',
            'admin.categories.destroy'  => 'delete categories',

            // Đơn hàng
            'admin.orders.update'       => 'update order status',


        ];

        $routeName = $request->route()->getName();

        if (isset($permissionsMap[$routeName]) && !$user->can($permissionsMap[$routeName])) {
            abort(403, 'Bạn không có quyền thực hiện hành động này.');
        }

        return $next($request);
    }
}
