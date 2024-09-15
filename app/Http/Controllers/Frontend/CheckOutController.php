<?php

namespace App\Http\Controllers\Frontend;

use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ShippingCenter;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

class CheckOutController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        if(Cart::count() == 0)
        {
            return redirect()->route('home')->with('warning', 'Add Products First !!');
        }

        $shippingMethods = ShippingCenter::where('status', 'active')->get();

        $addresses = UserAddress::where('user_id', auth()->user()->id)->get();

        return view('frontend.pages.checkout', compact(['addresses', 'shippingMethods']));
    }

    public function checkoutSubmit(Request $request)
    {
        /** Validate Request */
        $request->validate([
            'shipping_address_id' => ['required', 'integer', 'exists:user_addresses,id'],
            'shipping_method_id'  => ['required', 'integer', 'exists:shipping_centers,id']
        ]);

        /** Check DataBase */
        $userAddress = UserAddress::findOrFail($request->shipping_address_id)->toArray();
        $shipMethod = ShippingCenter::findOrFail($request->shipping_method_id);

        /** Save Sessions */
        if($userAddress)
        {
            Session::put('ship_address', $userAddress);
        }

        if($shipMethod)
        {
            Session::put('ship_method', [
                'id'   => $shipMethod->id,
                'name' => $shipMethod->name,
                'type' => $shipMethod->type,
                'cost' => $shipMethod->cost
            ]);
        }

        return response(['status' => 'success', 'redirect_url' => route('user.payment'),
        'message' => 'Order Placed Successfully ✅']);

    }
}
