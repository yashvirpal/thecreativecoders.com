<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;



Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // Profile routes
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    });
});


//auth('admin')->user()->hasRole('manager')
//auth('admin')->user()->hasPermission('edit_posts')
// Route::middleware(['auth:admin', 'admin.permission:edit_posts'])->group(function () {
//     Route::get('/admin/posts', ...);
// });
// Route::middleware(['auth:admin', 'admin.permission:view_reports'])->group(function () {
//     Route::get('/admin/reports', ...);
// });