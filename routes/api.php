<?php

use App\Http\Controllers\Api\ContactController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
    Route::get('/test', function () {
        return response()->json(['message' => 'API is working']);
    });

    Route::prefix('contacts')->group(function () {
        Route::get('/search', [ContactController::class, 'search']);
        Route::post('/', [ContactController::class, 'upsert']);
        Route::get('/{id}', [ContactController::class, 'show']);
        Route::delete('/{id}', [ContactController::class, 'delete']);
        Route::post('/{id}/call', [ContactController::class, 'call']);
    });
});