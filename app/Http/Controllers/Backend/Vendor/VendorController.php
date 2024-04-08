<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorController extends Controller
{

    public function dashboard()
    {
        return view('vendor.dashboard.dashboard');
    }
}
