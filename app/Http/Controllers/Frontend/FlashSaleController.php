<?php

namespace App\Http\Controllers\Frontend;

use App\Models\FlashSale;
use Illuminate\Http\Request;
use App\Models\FlashSaleItem;
use App\Http\Controllers\Controller;

class FlashSaleController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $items = FlashSaleItem::where('show_at_front', 'yes')->where('status', 'active')
                ->orderBy('id', 'asc')
                ->paginate(6);

        $flashTime = FlashSale::first();

        return view('frontend.pages.flash-sale', compact(['items', 'flashTime']));
    }
}
