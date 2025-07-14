<?php

use Illuminate\Support\Facades\Route;

require __DIR__.'/admin.php';

Route::get('/', [\App\Http\Controllers\Frontend\HomeController::class, 'index']);


Route::get('/', function () {
    return view('welcome');
});
