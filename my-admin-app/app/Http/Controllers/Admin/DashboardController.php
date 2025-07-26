<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $usersCount =0;// \App\Models\User::count();
        $postsCount = 0;//\App\Models\Post::count();
        $reportsCount = 0;//\App\Models\Report::count();

        return view('admin.dashboard.index', compact('usersCount', 'postsCount', 'reportsCount'));
        //return view('admin.dashboard.index');
    }

}
