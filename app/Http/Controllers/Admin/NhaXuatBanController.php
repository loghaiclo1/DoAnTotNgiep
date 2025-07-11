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
        $query = NhaXuatBan::query();

        if ($request->has('keyword') && $request->keyword != '') {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('TenNXB', 'like', "%$keyword%")
                  ->orWhere('Email', 'like', "%$keyword%")
                  ->orWhere('DienThoai', 'like', "%$keyword%")
                  ->orWhere('Website', 'like', "%$keyword%")
                  ->orWhere('slug', 'like', "%$keyword%");
            });
        }

        $nxb = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.nxb.index', compact('nxb'));
    }


    public function create()
    {
        return view('admin.nxb.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'TenNXB' => 'required|string|max:255|unique:nhaxuatban,TenNXB',
            'DiaChi' => 'required|string|max:255',
            'DienThoai' => 'required|regex:/^[0-9\-\+\(\)\s]+$/|max:20',
            'Email' => 'required|email|max:255',
            'Website' => 'required|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        ], [
            'TenNXB.unique' => 'Tên nhà xuất bản đã tồn tại.',
            'DienThoai.regex' => 'Số điện thoại không hợp lệ.',
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
            'TenNXB' => 'required|string|max:255|unique:nhaxuatban,TenNXB,' . $id . ',MaNXB',
            'DiaChi' => 'required|string|max:255',
            'DienThoai' => 'required|regex:/^[0-9\-\+\(\)\s]+$/|max:20',
            'Email' => 'required|email|max:255',
            'Website' => 'required|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        ], [
            'TenNXB.unique' => 'Tên nhà xuất bản đã tồn tại.',
            'DienThoai.regex' => 'Số điện thoại không hợp lệ. Chỉ chấp nhận số và các ký tự như +, -, ().',
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
}
