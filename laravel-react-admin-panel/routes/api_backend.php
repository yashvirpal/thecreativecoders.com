<?php

use App\Http\Controllers\Backend\Api\AuthController;
use App\Http\Controllers\Backend\Api\SettingController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:admin-api')->group(function () {
        Route::get('/me', fn($request) => $request->user());
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/settings', [SettingController::class, 'index']);
    });
});
