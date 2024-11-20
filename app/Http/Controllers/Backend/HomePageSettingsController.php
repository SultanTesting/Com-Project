<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomePageSettingsController extends Controller
{
    public function index()
    {
        return view('admin.website.home-page.index');
    }
}
