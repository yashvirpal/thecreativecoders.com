<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserController;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/backend.php';

Route::get('/', [HomeController::class, 'index']);
