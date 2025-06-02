<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Footer;
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

            $view->with('thongTinChung', $thongTinChung);
            $view->with('duLieuChanTrang', $mucCon);
            $view->with('tatCaDuLieu', $tatCaDuLieu);
        });
    }
}
