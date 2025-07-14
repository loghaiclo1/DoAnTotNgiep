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
        $tatCaDanhMucCha = Category::whereHas('children')->get();

        $query = Category::with(['children', 'parent'])
        ->whereIn('trangthai', [0, 1])
        ->orderByDesc('updated_at');

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

        // Kiểm tra nếu có danh mục con
        if ($danhMuc->children()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Không thể ẩn danh mục có danh mục con.');
        }

        // Kiểm tra nếu có sách thuộc danh mục
        if ($danhMuc->books()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Không thể ẩn danh mục có sách.');
        }

        // Xóa mềm: cập nhật trạng thái
        $danhMuc->update(['trangthai' => 1]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Danh mục đã được ẩn thành công!');
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
    public function restore($id)
{
    $danhMuc = Category::where('id', $id)->where('trangthai', 1)->firstOrFail();

    $danhMuc->update(['trangthai' => 0]);

    return redirect()->route('admin.categories.index')->with('success', 'Danh mục đã được khôi phục!');
}
}
