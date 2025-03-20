<?php

use Illuminate\Support\Facades\Route;

// Add this API test route
Route::get('/api/test', function () {
    return response()->json(['message' => 'API is working'])
        ->header('Content-Type', 'application/json');
});

// Add this test route BEFORE any SPA/fallback routes
Route::get('/test-web', function () {
    return response()->json(['message' => 'Web route is working'])
        ->header('Content-Type', 'application/json');
});

// Your SPA routes should be AFTER specific routes
Route::get('{any?}', function () {
    return view('app');
})->where('any', '^(?!api).*$');  // This regex pattern excludes paths starting with 'api'