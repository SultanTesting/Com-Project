<?php

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
        return '//cdn.datatables.net/plug-ins/2.0.3/i18n/ar.json';
    }

        return '//cdn.datatables.net/plug-ins/1.13.7/i18n/en-GB.json';
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

