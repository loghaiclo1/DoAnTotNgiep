<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Footer;
use App\Models\Category;
use App\Models\Book;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            // Lấy thông tin chung
            $thongTinChung = Footer::where('loai_du_lieu', 'thong_tin_chung')->first();

            // Lấy tất cả dữ liệu (bao gồm cả thong_tin_chung và muc_con) để hiển thị toàn bộ
            $tatCaDuLieu = Footer::all();

            // Lấy các mục con và nhóm theo ten_muc
            $mucCon = Footer::where('loai_du_lieu', 'muc_con')
                ->get()
                ->groupBy('ten_muc');

            $view->with([
                'dmWithTop3' => $this->getDmWithTop3ByParent(1),
                'dmWithTop3QT' => $this->getDmWithTop3ByParent(2),
                'thongTinChung' => $thongTinChung,
                'duLieuChanTrang' => $mucCon,
                'tatCaDuLieu' => $tatCaDuLieu,
            ]);
        });
    }
    private function getDmWithTop3ByParent($parentId)
    {
        $dmCap2 = Category::where('parent_id', $parentId)->get();
        $dmCap3All = Category::whereIn('parent_id', $dmCap2->pluck('id'))->get();

        $books1 = Book::select('category_id')
            ->selectRaw('COUNT(*) as book_count')
            ->groupBy('category_id')
            ->pluck('book_count', 'category_id');

        $dmCap3All = $dmCap3All->map(function ($cat) use ($books1) {
            $cat->book_count = $books1[$cat->id] ?? 0;
            return $cat;
        });

        return $dmCap2->map(function ($dm2) use ($dmCap3All) {
            $children = $dmCap3All->where('parent_id', $dm2->id)
                ->sortByDesc('book_count')
                ->take(4)
                ->values();
            $dm2->topChildren = $children;
            return $dm2;
        });
    }
}
