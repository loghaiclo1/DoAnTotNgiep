<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Footer;
use Illuminate\Support\Str;

class FooterController extends Controller
{
    public function index()
    {
        $footers = Footer::orderBy('loai_du_lieu')->get();
        return view('admin.footer.index', compact('footers'));
    }

    public function create()
    {
        return view('admin.footer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'loai_du_lieu'   => 'required|string|max:255',
            'ten_muc'        => 'required|string|max:255',
            'ten_muc_con'    => 'nullable|string|max:255',
            'noi_dung'       => 'nullable|string',
            'duong_dan'      => 'nullable|string|max:255',
        ]);

        if ($request->loai_du_lieu !== 'muc_con') {
            return back()->withErrors(['loai_du_lieu' => 'Chỉ được phép thêm dữ liệu loại mục con'])->withInput();
        }

        // Nếu là mạng xã hội hoặc user nhập sẵn thì lấy đường dẫn trực tiếp, ngược lại tạo slug
        $slugSource = $request->duong_dan ?: '/' . Str::slug($request->ten_muc_con ?: $request->ten_muc);

        // Kiểm tra trùng
        if (Footer::where('duong_dan', $slugSource)->exists()) {
            return back()->withErrors(['duong_dan' => 'Đường dẫn đã tồn tại!'])->withInput();
        }

       
        $footer = Footer::create([
            'loai_du_lieu'   => $request->loai_du_lieu,
            'ten_muc'        => $request->ten_muc,
            'ten_muc_con'    => $request->ten_muc_con,
            'duong_dan'      => $slugSource,
            'noi_dung'       => $request->noi_dung,
        ]);

        return redirect()->route('admin.footer.edit', $footer->id)
            ->with('success', 'Tạo mục thành công! Bạn có thể cập nhật nội dung chi tiết.');
    }
    public function edit($id)
    {
        $footer = Footer::findOrFail($id);
        return view('admin.footer.edit', compact('footer'));
    }

    public function update(Request $request, $id)
    {
        $footer = Footer::findOrFail($id);

        if ($footer->ten_muc === 'Tài Khoản Của Tôi') {
            return redirect()->back()->with('error', 'Không thể chỉnh sửa mục hệ thống!');
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
                'duong_dan'   => 'nullable|string|max:255',
            ]);

            $slugSource = $request->duong_dan ?: '/' . Str::slug($request->ten_muc_con ?: $request->ten_muc);

            // Kiểm tra trùng (bỏ qua chính mình)
            $exists = Footer::where('duong_dan', $slugSource)->where('id', '!=', $footer->id)->exists();
            if ($exists) {
                return back()->withErrors(['duong_dan' => 'Đường dẫn đã tồn tại!'])->withInput();
            }

            $footer->update([
                'ten_muc'     => $request->ten_muc,
                'ten_muc_con' => $request->ten_muc_con,
                'duong_dan'   => $slugSource,
                'noi_dung'    => $request->noi_dung,
            ]);
        }

        return redirect()->route('admin.footer.index')->with('success', 'Cập nhật footer thành công!');
    }
    public function destroy($id)
    {
        $footer = Footer::findOrFail($id);

        if (
            $footer->loai_du_lieu === 'thong_tin_chung' ||
            $footer->ten_muc === 'Tài Khoản Của Tôi'
        ) {
            return redirect()->back()->with('error', 'Không thể xoá thông tin chung hoặc mục mặc định của hệ thống!');
        }

        $footer->delete();

        return redirect()->route('admin.footer.index')->with('success', 'Xoá điều khoản thành công!');
    }
}
