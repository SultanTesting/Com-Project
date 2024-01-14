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

function dirSelect()
{
    if(LaravelLocalization::getLocalizedURL() == LaravelLocalization::getLocalizedURL('ar'))
    {
        return "rtl";
    }

        return "ltr";
}

function langSelect()
{
    if(dirSelect() == 'rtl')
    {
        return '//cdn.datatables.net/plug-ins/1.13.7/i18n/ar.json';
    }

        return '//cdn.datatables.net/plug-ins/1.13.7/i18n/en-GB.json';
}

function makeDirectory($dirName, $name)
{
    $subFolder = "uploads/$dirName/" . $name;
    Storage::makeDirectory($subFolder);

    return $subFolder;
}

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

