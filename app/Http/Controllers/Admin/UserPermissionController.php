<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KhachHang;
use Spatie\Permission\Models\Permission;

class UserPermissionController extends Controller
{
    public function edit($id)
    {
        $user = KhachHang::findOrFail($id);
        $permissions = Permission::all();

        return view('admin.accounts.permissions', compact('user', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $user = KhachHang::findOrFail($id);
        $user->syncPermissions($request->input('permissions', []));
        return redirect()->route('admin.accounts.index')->with('success', 'Cập nhật quyền thành công!');
    }
}
