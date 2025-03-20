<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/home';

    protected string $namespace = 'App\\Http\\Controllers';

    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            // Handle API routes first, before any SPA routing
            Route::middleware('web')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Handle web routes and SPA last
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}