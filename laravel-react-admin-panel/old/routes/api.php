<?php
// Frontend API routes (public/customer)
Route::prefix('v1')->group(function () {
    Route::get('/settings', [\App\Http\Controllers\Frontend\Api\SettingController::class, 'index']);
});
