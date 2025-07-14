<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Api\HomeController;

Route::prefix('v1')->group(function () {
    Route::get('/settings', [HomeController::class, 'index']);
});
