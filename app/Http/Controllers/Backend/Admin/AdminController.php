<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->except('login');
    }

    public function dashboard()
    {
        return view('admin.dashboard');

    }

    public function login()
    {
        return view('admin.auth.login');
    }


}
