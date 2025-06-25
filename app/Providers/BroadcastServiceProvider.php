<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Đăng ký route cho broadcasting
        Broadcast::routes();

        // Nạp các channel được định nghĩa
        require base_path('routes/channels.php');
    }
}
