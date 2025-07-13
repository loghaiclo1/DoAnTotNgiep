<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NhaXuatBan;
use Illuminate\Support\Str;

class NhaXuatBanController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->status;

        // Khởi tạo query dựa trên trạng thái
        if ($status === 'hidden') {
            $query = NhaXuatBan::onlyTrashed();
        } elseif ($status === 'active') {
            $query = NhaXuatBan::withoutTrashed();
        } else {
            $query = NhaXuatBan::withTrashed();
        }

        // Tìm kiếm theo từ khoá
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('TenNXB', 'like', "%$keyword%")
                  ->orWhere('Email', 'like', "%$keyword%")
                  ->orWhere('DienThoai', 'like', "%$keyword%")
                  ->orWhere('Website', 'like', "%$keyword%")
                  ->orWhere('slug', 'like', "%$keyword%");
            });
        }

        // Lấy danh sách
        $nxb = $query->orderByRaw('deleted_at IS NOT NULL')->orderBy('created_at', 'desc')->paginate(10);

        // Biến báo có bản ghi bị ẩn không
        $hasHidden = NhaXuatBan::onlyTrashed()->exists();

        return view('admin.nxb.index', compact('nxb', 'hasHidden'));
    }


    public function create()
    {
        return view('admin.nxb.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'TenNXB'    => 'required|string|max:255|unique:nhaxuatban,TenNXB',
            'DiaChi'    => 'required|string|max:255',
            'DienThoai' => 'required|regex:/^[0-9\-\+\(\)\s]+$/|max:20|unique:nhaxuatban,DienThoai',
            'Email'     => 'required|email|max:255|unique:nhaxuatban,Email',
            'Website'   => 'required|url|max:255|unique:nhaxuatban,Website',
            'image'     => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        ], [
            'TenNXB.unique'     => 'Tên nhà xuất bản đã tồn tại.',
            'Email.unique'      => 'Email đã tồn tại ở nhà xuất bản khác.',
            'Website.unique'    => 'Website đã tồn tại ở nhà xuất bản khác.',
            'DienThoai.unique'  => 'Số điện thoại đã tồn tại ở nhà xuất bản khác.',
            'DienThoai.regex'   => 'Số điện thoại không hợp lệ. Chỉ chấp nhận số.',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('nxb', 'public');
        }

        $data['slug'] = Str::slug($data['TenNXB']);
        NhaXuatBan::create($data);

        return redirect()->route('admin.nxb.index')->with('success', 'Thêm NXB thành công!');
    }

    public function edit($id)
    {
        $nxb = NhaXuatBan::findOrFail($id);
        return view('admin.nxb.edit', compact('nxb'));
    }

    public function update(Request $request, $id)
    {
        $nxb = NhaXuatBan::findOrFail($id);

        $data = $request->validate([
            'TenNXB'    => 'required|string|max:255|unique:nhaxuatban,TenNXB,' . $id . ',MaNXB',
            'DiaChi'    => 'required|string|max:255',
            'DienThoai' => 'required|regex:/^[0-9\-\+\(\)\s]+$/|max:20|unique:nhaxuatban,DienThoai,' . $id . ',MaNXB',
            'Email'     => 'required|email|max:255|unique:nhaxuatban,Email,' . $id . ',MaNXB',
            'Website'   => 'required|url|max:255|unique:nhaxuatban,Website,' . $id . ',MaNXB',
            'image'     => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        ], [
            'TenNXB.unique'     => 'Tên nhà xuất bản đã tồn tại.',
            'Email.unique'      => 'Email đã tồn tại ở nhà xuất bản khác.',
            'Website.unique'    => 'Website đã tồn tại ở nhà xuất bản khác.',
            'DienThoai.unique'  => 'Số điện thoại đã tồn tại ở nhà xuất bản khác.',
            'DienThoai.regex'   => 'Số điện thoại không hợp lệ. Chỉ chấp nhận số.',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('nxb', 'public');
        }

        $data['slug'] = Str::slug($data['TenNXB']);
        $nxb->update($data);

        return redirect()->route('admin.nxb.index')->with('success', 'Cập nhật NXB thành công!');
    }

    public function destroy($id)
    {
        $nxb = NhaXuatBan::findOrFail($id);
        $nxb->delete();

        return back()->with('success', 'Đã xóa nhà xuất bản!');
    }
    public function hide($id)
{
    $nxb = NhaXuatBan::findOrFail($id);
    $nxb->delete(); // Gán deleted_at
    return back()->with('success', 'NXB đã được ẩn!');
}

public function restore($id)
{
    $nxb = NhaXuatBan::withTrashed()->findOrFail($id);
    $nxb->restore(); // Gỡ deleted_at
    return back()->with('success', 'NXB đã được hiển thị lại!');
}

}
