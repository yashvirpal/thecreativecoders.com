<?php
// app/Http/Controllers/Admin/ErrorController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function error405()
    {die;
        return response()->view('errors.405', [], 405);
    }

    public function error404()
    {
        return response()->view('errors.404', [], 404);
    }
}
