<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class DanhMucController extends Controller
{
    public function index(Request $request)
    {
        // Chỉ lấy danh mục không có con (leaf categories)
        $tatCaDanhMucCha = Category::whereHas('children')->get();
        $query = Category::with(['children', 'parent']);

        if ($request->filled('filter_parent')) {
            $query->whereIn('parent_id', (array) $request->filter_parent);
        }

        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%$keyword%")
                  ->orWhere('slug', 'like', "%$keyword%")
                  ->orWhereHas('parent', function ($q2) use ($keyword) {
                      $q2->where('name', 'like', "%$keyword%");
                  });
            });
        }

        $danhMucs = $query->paginate(20)->withQueryString();

        return view('admin.danhmuc.index', compact('danhMucs', 'tatCaDanhMucCha'));
    }

    public function create()
    {
        $allDanhMucs = Category::all();
        $danhMucsCha = $this->buildCategoryTree($allDanhMucs);

        return view('admin.danhmuc.create', compact('danhMucsCha'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:danhmuc,id',
        ]);

        if (Category::where('name', $request->name)->exists()) {
            return back()->withErrors(['name' => 'Tên danh mục đã tồn tại.'])->withInput();
        }

        $slug = Str::slug($request->name);

        Category::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => $slug,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Thêm danh mục thành công!');
    }

    public function edit(string $id)
    {
        $danhMuc = Category::findOrFail($id);
        $allDanhMucs = Category::where('id', '!=', $id)->get();
        $danhMucsCha = $this->buildCategoryTree($allDanhMucs);

        return view('admin.danhmuc.edit', compact('danhMuc', 'danhMucsCha'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:danhmuc,id',
        ]);

        $danhMuc = Category::findOrFail($id);

        if (Category::where('name', $request->name)->where('id', '!=', $id)->exists()) {
            return back()->withErrors(['name' => 'Tên danh mục đã tồn tại.'])->withInput();
        }

        $slug = Str::slug($request->name);

        $danhMuc->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => $slug,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Cập nhật danh mục thành công!');
    }

    public function destroy(string $id)
    {
        $danhMuc = Category::findOrFail($id);

        if ($danhMuc->children()->count() > 0) {
            return redirect()->route('admin.categories.index')->with('error', 'Không thể xóa danh mục có danh mục con.');
        }

        $danhMuc->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Xóa danh mục thành công!');
    }

    private function buildCategoryTree($categories, $parentId = null, $prefix = '')
    {
        $result = [];

        foreach ($categories->where('parent_id', $parentId) as $category) {
            $result[] = [
                'id' => $category->id,
                'name' => $prefix . $category->name,
            ];
            $result = array_merge($result, $this->buildCategoryTree($categories, $category->id, $prefix . '— '));
        }

        return $result;
    }
}
