<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Api\HomeController;

require __DIR__.'/api_backend.php';

Route::prefix('v1')->group(function () {
    Route::get('/settings', [HomeController::class, 'index']);
});
