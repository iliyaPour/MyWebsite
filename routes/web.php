<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ProjectController;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// Public API endpoints
Route::get('/api/projects', [ProjectController::class, 'index']);
Route::post('/api/admin/login', [AdminAuthController::class, 'login']);
Route::get('/api/admin/check', [AdminAuthController::class, 'check']);

// Protected Admin API endpoints
Route::middleware('auth')->group(function () {
    Route::post('/api/admin/logout', [AdminAuthController::class, 'logout']);
    Route::post('/api/admin/change-password', [AdminAuthController::class, 'updatePassword']);
    Route::post('/api/admin/projects/upload-image', [ProjectController::class, 'uploadImage']);
    Route::post('/api/admin/projects', [ProjectController::class, 'store']);
    Route::match(['put', 'post'], '/api/admin/projects/{project}', [ProjectController::class, 'update']);
    Route::match(['delete', 'post'], '/api/admin/projects/{project}', [ProjectController::class, 'destroy']);
});

// Temporary Migration & Database Setup Route for hosts without Terminal/SSH
Route::get('/setup-artisan-migrate-secret-9821', function () {
    try {
        Artisan::call('migrate', ['--force' => true]);
        $output = Artisan::output();

        if (User::count() === 0) {
            Artisan::call('db:seed', ['--class' => 'AdminUserSeeder', '--force' => true]);
            $output .= "\n".Artisan::output();
        }

        return response("<pre style='background:#080b11;color:#22c55e;padding:24px;border-radius:16px;font-family:monospace;font-size:14px;line-height:1.6;border:1px solid #1e293b;'>[SUCCESS] دیتابیس و مایگریشن‌ها با موفقیت اجرا شدند!\n\n".e($output)."\n\nایمیل مدیر: admin@iliya.dev\nرمز عبور پیش‌فرض: iliya1234\n(می‌توانید پس از اولین ورود در پنل مدیریت رمز عبور را تغییر دهید)</pre>");
    } catch (Throwable $e) {
        return response("<pre style='background:#080b11;color:#ef4444;padding:24px;border-radius:16px;font-family:monospace;font-size:14px;line-height:1.6;border:1px solid #7f1d1d;'>[ERROR] خطا در اجرای دیتابیس:\n\n".e($e->getMessage()).'</pre>', 500);
    }
});

// Single Page Application (SPA) Catch-all Route
Route::get('/{any?}', function () {
    return view('welcome');
})->where('any', '^(?!api).*$');
