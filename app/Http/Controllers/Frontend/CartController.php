<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /** Add To Cart Method */
    public function addToCart(Request $request)
    {
        /** 1- Find The Product & Variants */
        $product = Product::findOrFail($request->product_id);
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
        $cartData['options']['image'] = $product->thumb_image;
        $cartData['options']['slug'] = $product->slug;
        $cartData['price'] = $finalPrice * $request->qty;

        Cart::add($cartData);

        return response(['status' => 'success', 'message' => 'success']);
    }


    /** Cart Details Page */

    public function cartDetails(Request $request)
    {
        $cart = Cart::content();

        return view('frontend.pages.cart-details', compact('cart'));
    }
}
