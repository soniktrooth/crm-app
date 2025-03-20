<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Configuration\Exceptions;
use App\Exceptions\Handler;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php'
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->group('api', [
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (\Exception $e, Request $request) {
            if ($request->is('api/*') || $request->wantsJson()) {
                return response()->json([
                    'message' => $e->getMessage()
                ], 500);
            }
        });
    })
    ->create();
