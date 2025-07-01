<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KhachHang;
use Illuminate\Http\Request;
use App\Events\AccountLocked;
class AccountController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\KhachHang::query();

        if ($request->filled('q')) {
            $keyword = $request->input('q');
            $query->where(function ($q) use ($keyword) {
                $q->whereRaw('LOWER(Ho) LIKE ?', ['%' . strtolower($keyword) . '%'])
                  ->orWhereRaw('LOWER(Ten) LIKE ?', ['%' . strtolower($keyword) . '%'])
                  ->orWhereRaw('LOWER(email) LIKE ?', ['%' . strtolower($keyword) . '%']);
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->input('role'));
        }

        $accounts = $query->paginate(10)->appends($request->query());

        return view('admin.accounts', compact('accounts'));
    }

    public function edit($id)
{
    $account = KhachHang::findOrFail($id);
    return view('admin.accounts.edit', compact('account'));
}
public function update(Request $request, $id)
{
    $validated = $request->validate([
        'Ho' => 'required|string|max:100',
        'Ten' => 'required|string|max:100',
        'email' => 'required|email|max:255',
        'role' => 'required|in:user,admin,superadmin',
    ]);

    $account = KhachHang::findOrFail($id);
    $account->update($validated);

    return redirect()->route('admin.admin.accounts')->with('success', 'Cập nhật tài khoản thành công!');
}
public function destroy($id)
{
    $account = \App\Models\KhachHang::findOrFail($id);

    if ($account->role === 'superadmin') {
        return redirect()->back()->with('error', 'Không thể xoá superadmin.');
    }

    $account->delete();

    return redirect()->route('admin.admin.accounts')->with('success', 'Xoá tài khoản thành công.');
}
public function toggle($id)
{
    $account = KhachHang::findOrFail($id);
    $account->TrangThai = !$account->TrangThai;
    $account->save();

    if ($account->TrangThai == 0) {
        event(new AccountLocked($account->id));
    }

    return redirect()->back()->with('success', 'Cập nhật trạng thái tài khoản thành công.');
}
}
