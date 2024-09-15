<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductVariantItem;
use function Laravel\Prompts\error;
use App\Http\Controllers\Controller;
use App\Models\GeneralSettings;
use Illuminate\Support\Facades\Config;

use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    /** Add To Cart Method */
    public function addToCart(Request $request)
    {
        /** 1- Find The Product & Variants */
        $product = Product::findOrFail($request->product_id);

        /** Quantity Validation */
        if(Cart::count() > 1)
        {
            foreach(Cart::content()->where('id', $request->product_id) as $cartItem){
                if($product->quantity <= $cartItem->qty || $product->quantity < $request->qty)
                {
                    return response('Cannot Exceed Product Max Quantity !', 406);
                }
            }
        }

        $variants = [];
        $variantPrice = 0;

        if($request->variants)
        {
            foreach($request->variants as $variantItem)
            {
                $item = ProductVariantItem::findOrFail($variantItem);

                $variants[$item->variant->name]['name']  = $item->name;
                $variants[$item->variant->name]['price'] = $item->price;
                $variantPrice += $item->price;
            }
        }

        /** 2- Check If There any Offers And Calc Final Price */

        $productPrice = 0;
        if(checkDiscount($product))
        {
            $productPrice = $product->offer_price;
        }else{
            $productPrice = $product->price;
        }

        $finalPrice = $productPrice + $variantPrice;

        /** 3- Sending Data To Cart  */

        $cartData['id'] = $product->id;
        $cartData['name'] = $product->name;
        $cartData['qty'] = $request->qty;
        $cartData['weight'] = 0;
        $cartData['options']['original_price'] = $productPrice;
        $cartData['options']['variants'] = $variants;
        $cartData['options']['variants_price'] = $variantPrice;
        $cartData['options']['max'] = $product->quantity;
        $cartData['options']['image'] = $product->thumb_image;
        $cartData['options']['slug'] = $product->slug;
        $cartData['price'] = $finalPrice;

        Cart::add($cartData);

        return response(['status' => 'success', 'message' => 'Product Added To Cart']);
    }


    /** Cart Details Page */

    public function cartDetails(Request $request)
    {
        $cart = Cart::content();
        $subTotal = Cart::subtotal('0');
        $total = Cart::priceTotal('0');

        if(Cart::count() === 0)
        {
            Session::forget(['coupon', 'ship_address', 'ship_method']);
        }

        return view('frontend.pages.cart-details', compact(['cart', 'subTotal', 'total']));
    }

    /** Update Cart Quantity */
    public function updateQty(Request $request)
    {
        $productId = Cart::get($request->rowId)->id;
        $product = Product::findOrFail($productId);

        if($product->quantity < $request->qty ){
            return response(['status' => 'error', 'message' => 'Quantity not available in our stock !']);
        }

        Cart::update($request->rowId, $request->qty);
        $productTotalPrice = $this->getProductTotal($request->rowId);

        return response(['status' => 'success', 'message' => __('Updated Successfully'), 'product_total' => $productTotalPrice]);
    }

    /** Get Product Total Prices */
    public function getProductTotal($rowId)
    {
        $product = Cart::get($rowId);
        $total = ($product->options->original_price + $product->options->variants_price) * $product->qty;

        return $total;
    }

    public function clearItem($rowid)
    {
        Cart::remove($rowid);

        if(Cart::count() === 0)
        {
            Session::forget(['coupon', 'ship_address', 'ship_method']);
        }

        return back()->with('message', 'Item Removed From Cart');
    }

    public function clearAll()
    {
        Cart::destroy();
        Session::forget(['coupon', 'ship_address', 'ship_method']);

        return response(['status' => 'success', 'message' => 'Cart Empty Now']);
    }

    public function cartCounter()
    {
        return Cart::content()->count();
    }

    public function miniCart()
    {
        return Cart::content();
    }

    public function miniCartSubTotal()
    {
        return Cart::subtotal('0');
    }

    public function checkProductQty($rowId)
    {
        return Cart::get($rowId);
    }

    public function cartCoupon(Request $request)
    {
        if($request->coupon_name === null)
        {
            return response('Coupon is empty !!', 406);
        }

        $coupon = Coupon::where(['code' => $request->coupon_name, 'status' => 'active'])->first();
        $subTotal = (int) Cart::subTotal('0', '.', false);


        if($coupon === null)
        {
            return response('Coupon not found !!', 406);

        }elseif($coupon->start_date > today() || $coupon->end_date < today())
        {
            return response('Coupon not found !!', 406);

        }elseif($coupon->total_used >= $coupon->quantity)
        {
            return response('Coupon has exceeded the number available for use !', 406);

        }elseif($coupon->discount_type === 'cash' && $coupon->discount >= $subTotal)
        {
            return response('Cannot Apply This Coupon Here !', 406);
        }

        if($coupon->discount_type === 'cash')
        {
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'cash',
                'discount' => $coupon->discount
            ]);

        }elseif($coupon->discount_type === 'percentage')
        {
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'percentage',
                'discount' => $coupon->discount
            ]);
        }

        return response(['status' => 'success', 'message' => 'Coupon Applied']);
    }

    public function couponCalc()
    {
        $subTotal = (int) Cart::subTotal('0', '.', false);

        if(Session::has('coupon'))
        {
            $coupon = Session::get('coupon');

            if($coupon['discount_type'] === 'cash')
            {
                if($coupon['discount'] >= $subTotal)
                {
                    Session::forget('coupon');

                    return response(['status' => 'success', 'total' => $subTotal, 'discount' => 0]);

                }else {
                    $total = $subTotal - $coupon['discount'];
                    $settings = GeneralSettings::first();

                    return response(['status' => 'success', 'total' => $total, 'discount' => $coupon['discount'] . $settings->currency_icon]);
                }

            }elseif($coupon['discount_type'] === 'percentage')
            {
                $percentage = 1 - ($coupon['discount'] / 100);

                $total = (int)($subTotal * $percentage);

                return response(['status' => 'success', 'total' => $total, 'discount' => $coupon['discount'] . '%']);

            }
        }else {

            return response(['status' => 'success', 'total' => $subTotal, 'discount' => 0]);
        }
    }
}
