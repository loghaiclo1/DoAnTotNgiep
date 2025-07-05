<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Footer;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class FooterController extends Controller
{
    // Hiển thị danh sách điều khoản
    public function index()
    {
        $footers = Footer::orderBy('loai_du_lieu')->get();
        return view('admin.footer.index', compact('footers'));
    }

    // Form tạo điều khoản mới
    public function create()
    {
        return view('admin.footer.create');
    }

    // Lưu điều khoản mới
    public function store(Request $request)
    {
        $request->validate([
            'loai_du_lieu'   => 'required|string|max:255',
            'ten_muc'        => 'required|string|max:255',
            'ten_muc_con'    => 'nullable|string|max:255',
            'noi_dung'       => 'nullable|string',
        ]);

        $slugSource = $request->ten_muc_con ?: $request->ten_muc;
        $slug = '/' . Str::slug($slugSource);

        // Kiểm tra trùng slug
        if (Footer::where('duong_dan', $slug)->exists()) {
            return back()->withErrors(['ten_muc_con' => 'Tên mục con dẫn đã tồn tại!'])->withInput();
        }

        Footer::create([
            'loai_du_lieu'   => $request->loai_du_lieu,
            'ten_muc'        => $request->ten_muc,
            'ten_muc_con'    => $request->ten_muc_con,
            'duong_dan'      => $slug,
            'noi_dung'       => $request->noi_dung,
        ]);

        return redirect()->route('admin.footer.index')->with('success', 'Thêm điều khoản thành công!');
    }

    // Form sửa điều khoản
    public function edit($id)
    {
        $footer = Footer::findOrFail($id);
        return view('admin.footer.edit', compact('footer'));
    }

    // Cập nhật điều khoản
    public function update(Request $request, $id)
    {
        $footer = Footer::findOrFail($id);
        if ($footer->ten_muc === 'Tài Khoản Của Tôi') {
            return redirect()->back()->with('error', 'Không thể chỉnh sửa hoặc xoá các mục mặc định của hệ thống!');
        }
        if ($footer->loai_du_lieu === 'thong_tin_chung') {
            $request->validate([
                'ten_cong_ty' => 'required|string|max:255',
                'dia_chi'     => 'nullable|string|max:255',
                'email'       => 'nullable|email|max:255',
                'dien_thoai'  => 'nullable|string|max:50',
                'mo_ta'       => 'nullable|string',
            ]);

            $footer->update([
                'ten_cong_ty' => $request->ten_cong_ty,
                'dia_chi'     => $request->dia_chi,
                'email'       => $request->email,
                'dien_thoai'  => $request->dien_thoai,
                'mo_ta'       => $request->mo_ta,
            ]);
        } else {
            $request->validate([
                'ten_muc'     => 'required|string|max:255',
                'ten_muc_con' => 'nullable|string|max:255',
                'noi_dung'    => 'nullable|string',
            ]);

            $slugSource = $request->ten_muc_con ?: $request->ten_muc;
            $slug = '/' . Str::slug($slugSource);

            // Kiểm tra trùng slug nhưng bỏ qua chính nó
            $exists = Footer::where('duong_dan', $slug)->where('id', '!=', $footer->id)->exists();
            if ($exists) {
                return back()->withErrors(['ten_muc_con' => 'Tên mục con dẫn đã tồn tại!'])->withInput();
            }

            $footer->update([
                'ten_muc'     => $request->ten_muc,
                'ten_muc_con' => $request->ten_muc_con,
                'duong_dan'   => $slug,
                'noi_dung'    => $request->noi_dung,
            ]);
        }

        return redirect()->route('admin.footer.index')->with('success', 'Cập nhật footer thành công!');
    }

    // Xoá điều khoản
    public function destroy($id)
    {
        if ($footer->ten_muc === 'Tài Khoản Của Tôi') {
            return redirect()->back()->with('error', 'Không thể chỉnh sửa hoặc xoá các mục mặc định của hệ thống!');
        }
        $footer = Footer::findOrFail($id);
        $footer->delete();

        return redirect()->route('admin.footer.index')->with('success', 'Xoá điều khoản thành công!');
    }
}
