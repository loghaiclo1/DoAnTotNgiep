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


        if ($user->role === 'user') {
            return redirect()->route('admin.accounts.index')->with('error', 'Không thể phân quyền cho tài khoản người dùng thường.');
        }

        $permissions = Permission::all();

        return view('admin.accounts.permissions', compact('user', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $user = KhachHang::findOrFail($id);


        if ($user->role === 'user') {
            return redirect()->route('admin.accounts.index')->with('error', 'Không thể cập nhật quyền cho tài khoản người dùng thường.');
        }

        $user->syncPermissions($request->input('permissions', []));

        return back()->with('success', 'Cập nhật quyền thành công!');
    }
}
