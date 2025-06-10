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

            $dmCap2 = Category::where('parent_id', 1)->take(4)->get();

            $dmCap3 = Category::whereIn('parent_id', $dmCap2->pluck('id'))->get();

            $dmCap3 = $dmCap3->map(function ($dm) {
                $dm->book_count = Book::where('category_id', $dm->id)->count();
                return $dm;
            })->sortByDesc('book_count')->take(4)->values();

            $view->with([
                'dmCap2' => $dmCap2,
                'dmCap3' => $dmCap3,
                'thongTinChung' => $thongTinChung,
                'duLieuChanTrang' => $mucCon,
                'tatCaDuLieu' => $tatCaDuLieu,
            ]);
        });
    }
}
