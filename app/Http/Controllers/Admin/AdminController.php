<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function home()
    {
        dd(2);
        return view('admin.pages.dashboard');
    }

    public function dashboard()
    {
        dd(4);
        return view('admin.pages.dashboard');
    }
}
