<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TacGia;

class TacGiaController extends Controller
{
    public function index(Request $request)
    {
        $query = TacGia::query();

        if ($request->filled('q')) {
            $query->where('TenTacGia', 'like', '%' . $request->q . '%');
        }

        $tacgias = $query->orderByDesc('created_at')->paginate(10);
        return view('admin.tacgia', compact('tacgias'));
    }

    public function create()
    {
        return view('admin.tacgia.create');
    }

    public function store(Request $request)
    {
        $request->validate(['TenTacGia' => 'required|string|max:255']);
        TacGia::create($request->only('TenTacGia'));

        return redirect()->route('admin.tacgia.index')->with('success', 'Thêm tác giả thành công!');
    }

    public function edit($id)
    {
        $tacgia = TacGia::findOrFail($id);
        return view('admin.tacgia.edit', compact('tacgia'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'TenTacGia' => 'required|string|max:255'
    ]);

    $tacgia = TacGia::findOrFail($id);
    $tacgia->update(['TenTacGia' => $request->TenTacGia]);

    if ($request->ajax()) {
        return response()->json(['success' => true, 'message' => 'Cập nhật thành công!']);
    }

    return redirect()->route('admin.tacgia.index')->with('success', 'Cập nhật tác giả thành công!');
}


    public function destroy($id)
    {
        TacGia::findOrFail($id)->delete();
        return redirect()->route('admin.tacgia.index')->with('success', 'Xóa tác giả thành công!');
    }
    public function show($id)
{
    $tacgia = TacGia::findOrFail($id);
    return response()->json($tacgia);
}
}
