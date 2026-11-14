<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

// Public API endpoints
Route::get('/api/projects', [ProjectController::class, 'index']);
Route::post('/api/admin/login', [AdminAuthController::class, 'login']);
Route::get('/api/admin/check', [AdminAuthController::class, 'check']);

// Protected Admin API endpoints
Route::middleware('auth')->group(function () {
    Route::post('/api/admin/logout', [AdminAuthController::class, 'logout']);
    Route::post('/api/admin/change-password', [AdminAuthController::class, 'updatePassword']);
    Route::post('/api/admin/projects', [ProjectController::class, 'store']);
    Route::put('/api/admin/projects/{project}', [ProjectController::class, 'update']);
    Route::delete('/api/admin/projects/{project}', [ProjectController::class, 'destroy']);
});

// Single Page Application (SPA) Catch-all Route
Route::get('/{any?}', function () {
    return view('welcome');
})->where('any', '^(?!api).*$');
