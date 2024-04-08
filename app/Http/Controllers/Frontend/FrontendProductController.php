<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $slug)
    {
        $product = Product::with(['vendor', 'category', 'brand', 'gallery', 'variants'])
        ->where('slug', $slug)->where('status', 'active')->first();
        $flashTime = FlashSale::first();
        return view('frontend.pages.product-detail', compact(['product', 'flashTime']));
    }
}
