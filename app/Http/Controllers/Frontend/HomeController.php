<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Slider;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 'Active')->latest()->get();
        $flashItems = FlashSaleItem::with('product')->where('show_at_front', 'yes')->where('status', 'active')->get();
        $flash_end = FlashSale::first();
        return view('frontend.home.home', compact(['sliders', 'flashItems', 'flash_end']));
    }
}
