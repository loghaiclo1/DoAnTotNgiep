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

                $view->with([
                    'dmWithTop3'       => $this->getDmWithTop3ByParent(1),
                    'dmWithTop3QT'     => $this->getDmWithTop3ByParent(2),
                    'thongTinChung'    => $thongTinChung,
                    'duLieuChanTrang'  => $duLieuChanTrang,
                ]);
            });
        } catch (\Exception $e) {
            \Log::error("View Composer Error: " . $e->getMessage());
        }
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

        $dmCap2 = $dmCap2->map(function ($dm2) use ($dmCap3All) {
            $children = $dmCap3All->where('parent_id', $dm2->id)
                ->sortByDesc('book_count')
                ->take(4)
                ->values();
            $dm2->topChildren = $children;
            return $dm2;
        });

        return $dmCap2->chunk(4);
    }
}
