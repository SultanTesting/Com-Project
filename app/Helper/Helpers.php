<?php

use App\Models\GeneralSettings;
use App\Models\PaypalSettings;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/** Make SideBar Item Active */

function setActive(array $route)
{
    if(is_array($route))
    {
        foreach($route as $r)
        {
            if(request()->routeIs($r))
            {
                return 'active';
            }

        }
    }
}

/** Change Status  */

function changeStatus($model, $request)
{
    $model->status = ($request->status == 'true') ? 'active' : 'inactive';
    return $model->save();
}

/** Localization Direction  */

function dirSelect()
{
    if(LaravelLocalization::getLocalizedURL() == LaravelLocalization::getLocalizedURL('ar'))
    {
        return "rtl";
    }

        return "ltr";
}

/** Language Select For DataTables */

function langSelect()
{
    if(dirSelect() == 'rtl')
    {
        return '//cdn.datatables.net/plug-ins/2.1.8/i18n/ar.json';
    }else{

        return '//cdn.datatables.net/plug-ins/1.13.7/i18n/en-GB.json';
    }

}

/** Create Directory For Each Upload File */

function makeDirectory($dirName, $name)
{
    $subFolder = "uploads/$dirName/" . $name;
    Storage::makeDirectory($subFolder);

    return $subFolder;
}

/** Prevent User From Delete Parent if there is child items */

function protectWrongDelete($subItem, $mainItem, $messageMainItemName)
{
    if($subItem > 0)
    {
        return response([
            'status' => 'error',
            'message' => __("Cannot Delete This $messageMainItemName, Delete Items First!")
        ]);
    }else{

        $mainItem->delete();

        return response(['status' => 'success', 'message' => __('Deleted', ['name' => $mainItem->name])]);
    }
}

/** Check if discount is valid */

function checkDiscount($product)
{
    $today = date("Y-m-d");

    if($product->offer_price > 0 && $today >= $product->offer_start_date && $today <= $product->offer_end_date)
    {
        return true;
    }
        return false;

}

/** Calculate Discount Percentage */
function discountPercent($price, $offerPrice)
{
    $diff = $price - $offerPrice;

    $percent =  round($diff / $price * 100);

    return $percent;
}

/** Check Product Label */
function productLabel($product)
{
    switch ($product) {
        case "new":
            return 'New';
            break;

        case 'featured':
            return "Featured";
            break;

        case 'top':
            return 'top';
            break;

        default:
            return "New";
            break;
    }
}

function mainCartTotal()
{
    if(Session::has('coupon'))
    {
        $coupon = Session::get('coupon');
        $subTotal = Cart::subtotal('0', '.', false);

        if($coupon['discount_type'] === 'cash')
        {
            $total = $subTotal - $coupon['discount'];

            return $total;

        }elseif($coupon['discount_type'] === 'percentage')
        {
            $percentage = 1 - ($coupon['discount'] / 100);

            $total = (int) ($subTotal * $percentage);

            return $total;
        }
    }else {
        return Cart::subtotal('0', '.', false);
    }
}

function getCartDiscount()
{
    if(Session::has('coupon'))
    {
        $coupon = Session::get('coupon');
        $settings = GeneralSettings::first();

        if($coupon['discount_type'] === 'percentage')
        {
            $discount = $coupon['discount']  . '%';

            return $discount;

        }elseif($coupon['discount_type'] === 'cash')
        {
            $discount = $coupon['discount'] . $settings->currency_icon;

            return $discount;
        }
    }else {

        return 0;
    }
}

function getShippingFee()
{
    if(Session::has('ship_method'))
    {
        return Session::get('ship_method')['cost'];
    }else {
        return 0;
    }
}

function getFinalAmount()
{
    if(Session::has('ship_method'))
    {
        Session::put('final_amount', [
            'final_amount' => (mainCartTotal() + getShippingFee())
        ]);

        return number_format(mainCartTotal() + getShippingFee());
    } else {
        return "Back To Products !";
    }
}

/** Order Status Function */

function orderStatus()
{
    return [
        'admin_order_status' => [
        'pending' => [
            'status'  => __('Pending'),
            'details' => __('Your Order Status: Pending')
        ],
        'canceled' => [
            'status'  => __('Canceled'),
            'details' => __('Canceled')
        ],
        'processed_ready' => [
            'status'  => __('Processed & Ready'),
            'details' => __('Your Package Is Ready Now, It Will Be With Delivery Soon')
        ],
        'dropped_off' => [
            'status'  => __('Dropped Off'),
            'details' => __('Your Package Has Been Dropped Off By The Seller')
        ],
        'shipped' => [
            'status'  => __('Shipped'),
            'details' => __('Your Package Has Arrived At Our Warehouse')
        ],
        'out_for_delivery' => [
            'status'  => __('Out For Delivery'),
            'details' => __('Our Delivery Partner Received Your Package, It Will Arrive Soon')
        ],
        'delivered' => [
            'status'  => __('Delivered'),
            'details' => __('Congrats, Your Package Has Been Delivered')
        ]
        ],

        'vendor_order_status' => [
        'pending' => [
            'status'  => __('Pending'),
            'details' => __('Your Order Status: Pending')
        ],
        'processed_ready' => [
            'status'  => __('Processed & Ready'),
            'details' => __('Your Package Is Ready Now, It Will Be With Delivery Soon')
        ],
        ]
    ];
}

