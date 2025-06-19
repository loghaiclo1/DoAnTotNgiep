<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Log;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/home';

    public function boot(): void
    {
        Log::info('RouteServiceProvider: Loading routes');
        $this->routes(function () {
            Log::info('RouteServiceProvider: Loading web routes');
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Log::info('RouteServiceProvider: Loading api routes from ' . base_path('routes/api.php'));
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
        });
    }
}
