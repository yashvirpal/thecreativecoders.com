<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        dd("Dashboard Index");
        // You can pass data to the dashboard view here
        return view('dashboard.index');
    }
}
