<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DonViPhatHanh;
use Illuminate\Support\Str;

class DonViPhatHanhController extends Controller
{
    public function index(Request $request)
    {
        $query = DonViPhatHanh::query();

        if ($request->has('keyword') && $request->keyword != '') {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('TenDVPH', 'like', "%$keyword%")
                  ->orWhere('Email', 'like', "%$keyword%")
                  ->orWhere('DienThoai', 'like', "%$keyword%")
                  ->orWhere('DiaChi', 'like', "%$keyword%")
                  ->orWhere('slug', 'like', "%$keyword%");
            });
        }

        $ds = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.donviphathanh.index', compact('ds'));
    }

    public function create()
    {
        return view('admin.donviphathanh.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'TenDVPH' => 'required|string|max:255|unique:donviphathanh,TenDVPH',
            'DiaChi' => 'required|string|max:255',
            'DienThoai' => 'required|regex:/^[0-9\-\+\(\)\s]+$/|max:20|unique:donviphathanh,DienThoai',
            'Email' => 'required|email|max:255|unique:donviphathanh,Email',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        ], [
            'TenDVPH.unique' => 'Tên đơn vị phát hành đã tồn tại.',
            'Email.unique' => 'Email này đã được sử dụng bởi một đơn vị phát hành khác.',
            'DienThoai.unique' => 'Số điện thoại này đã được dùng bởi một đơn vị phát hành khác.',
            'DienThoai.regex' => 'Số điện thoại không hợp lệ. Vui lòng chỉ nhập số.',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('dvph', 'public');
        }

        $data['slug'] = Str::slug($data['TenDVPH']);
        DonViPhatHanh::create($data);

        return redirect()->route('admin.donviphathanh.index')->with('success', 'Thêm đơn vị phát hành thành công!');
    }

    public function edit($id)
    {
        $dv = DonViPhatHanh::findOrFail($id);
        return view('admin.donviphathanh.edit', compact('dv'));
    }

    public function update(Request $request, $id)
    {
        $dv = DonViPhatHanh::findOrFail($id);
        $data = $request->validate([
            'TenDVPH' => 'required|string|max:255|unique:donviphathanh,TenDVPH,' . $id . ',MaDVPH',
            'DiaChi' => 'required|string|max:255',
            'DienThoai' => 'required|regex:/^[0-9\-\+\(\)\s]+$/|max:20|unique:donviphathanh,DienThoai,' . $id . ',MaDVPH',
            'Email' => 'required|email|max:255|unique:donviphathanh,Email,' . $id . ',MaDVPH',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        ],[
            'TenDVPH.unique' => 'Tên đơn vị phát hành đã tồn tại.',
            'Email.unique' => 'Email này đã được sử dụng bởi một đơn vị phát hành khác.',
            'DienThoai.unique' => 'Số điện thoại này đã được dùng bởi một đơn vị phát hành khác.',
            'DienThoai.regex' => 'Số điện thoại không hợp lệ. Vui lòng chỉ nhập số.',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('dvph', 'public');
        }

        $data['slug'] = \Str::slug($data['TenDVPH']);
        $dv->update($data);

        return redirect()->route('admin.donviphathanh.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy($id)
    {
        $dv = DonViPhatHanh::findOrFail($id);
        $dv->delete();

        return back()->with('success', 'Đã xóa đơn vị phát hành!');
    }
}
