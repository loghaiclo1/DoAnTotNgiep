<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\View;
use App\Models\Footer;
use App\Models\Category;
use App\Models\Book;
use Illuminate\Contracts\Foundation\Application as AppContract;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole() && !$this->app->runningUnitTests()) {
            return;
        }

        $this->bootViewComposer();

        if (file_exists(base_path('routes/channels.php'))) {
            Broadcast::routes();
            require base_path('routes/channels.php');
        }
    }
    protected function bootViewComposer()
    {
        try {
            View::composer('*', function ($view) {
                $thongTinChung = Footer::where('loai_du_lieu', 'thong_tin_chung')->first();

                // Lấy các mục con (mục điều khoản, hỗ trợ...)
                $duLieuChanTrang = Footer::where('loai_du_lieu', 'muc_con')
                    ->select('ten_muc', 'ten_muc_con', 'duong_dan')
                    ->get()
                    ->groupBy('ten_muc'); // group theo tên menu lớn: Dịch Vụ, Hỗ Trợ...

                $dmCap2 = Category::where('parent_id', 1)->get();
                $dmCap3 = Category::whereIn('parent_id', $dmCap2->pluck('id'))->get()->groupBy('parent_id');

                $view->with([
                    'dmCap2'       => $dmCap2,
                    'dmCap3'     => $dmCap3,
                    'thongTinChung'    => $thongTinChung,
                    'duLieuChanTrang'  => $duLieuChanTrang,
                ]);
            });
        } catch (\Exception $e) {
            \Log::error("View Composer Error: " . $e->getMessage());
        }
    }
}
