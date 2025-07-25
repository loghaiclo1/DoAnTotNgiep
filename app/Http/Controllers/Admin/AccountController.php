<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KhachHang;
use Illuminate\Http\Request;
use App\Events\AccountLocked;
use App\Events\AccountDeleted;

use Illuminate\Support\Facades\Log;

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
        if ($request->filled('status')) {
            $query->where('TrangThai', $request->status);
        }
        $accounts = $query->paginate(10)->appends($request->query());
        $query->orderByDesc('last_login_at');
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

        return redirect()->route('admin.accounts.index')->with('success', 'Cập nhật tài khoản thành công!');
    }
    public function destroy($id)
    {
        $account = KhachHang::findOrFail($id);


        if ($account->role === 'superadmin') {
            Log::warning('Attempt to delete superadmin account: MaKhachHang=' . $account->MaKhachHang);
            return redirect()->back()->with('error', 'Không thể xóa tài khoản superadmin.');
        }

        Log::info('Deleting account: MaKhachHang=' . $account->MaKhachHang);


        $account->addresses()->delete(); // Xóa địa chỉ liên quan

        // Phát sự kiện AccountDeleted trước khi xóa
        event(new AccountDeleted($account->MaKhachHang));

        // Xóa tài khoản
        $account->delete();

        return redirect()->route('admin.accounts.index')->with('success', 'Xóa tài khoản thành công.');
    }
    public function toggle($id)
    {
        $account = KhachHang::findOrFail($id);

        // Không cho phép khóa/mở khóa superadmin
        if ($account->role === 'superadmin') {
            \Log::warning('Cố gắng khóa superadmin: MaKhachHang=' . $account->MaKhachHang);
            return redirect()->back()->with('error', 'Không thể khóa hoặc mở khóa tài khoản superadmin.');
        }

        \Log::info('Toggling account ID: ' . $id . ', Current TrangThai: ' . $account->TrangThai);
        $account->TrangThai = !$account->TrangThai;
        $account->save();

        \Log::info('After toggle, TrangThai: ' . $account->TrangThai . ', Account ID: ' . $account->id);

        if ($account->TrangThai == 0) {
            \Log::info('Firing AccountLocked event for user: ' . $account->id);
            event(new AccountLocked($account->MaKhachHang));
        }

        return redirect()->back()->with('success', 'Cập nhật trạng thái tài khoản thành công.');
    }

}
