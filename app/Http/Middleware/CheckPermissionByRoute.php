<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
            'admin.orders.update'       => 'update orders',
            'admin.orders.cancel'       => 'cancel orders',

            // Phiếu nhập
            'admin.phieunhap.store'     => 'create phieunhaps',
            'admin.phieunhap.update'    => 'edit phieunhaps',
            'admin.phieunhap.destroy'   => 'delete phieunhaps',

            // Nhà xuất bản (NXB)
            'admin.nxb.store'           => 'create nxb',
            'admin.nxb.update'          => 'edit nxb',
            'admin.nxb.destroy'         => 'delete nxb',
            'admin.nxb.hide'            => 'hide nxb',
            'admin.nxb.restore'         => 'restore nxb',

            // Đơn vị phát hành (DVPH)
            'admin.donviphathanh.store'     => 'create dvph',
            'admin.donviphathanh.update'    => 'edit dvph',
            'admin.donviphathanh.destroy'   => 'delete dvph',
            'admin.donviphathanh.hide'      => 'hide dvph',
            'admin.donviphathanh.restore'   => 'restore dvph',

            // Tác giả
            'admin.tacgia.store'        => 'create tacgia',
            'admin.tacgia.update'       => 'edit tacgia',

            'admin.tacgia.destroy'         => 'hide tacgia',
            'admin.tacgia.restore'      => 'restore tacgia',
        ];

        $routeName = $request->route()->getName();

        if (isset($permissionsMap[$routeName]) && !$user->can($permissionsMap[$routeName])) {
            abort(403, 'Bạn không có quyền thực hiện hành động này.');
        }

        return $next($request);
    }
}
