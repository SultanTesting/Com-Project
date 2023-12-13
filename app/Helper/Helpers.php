<?php

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

