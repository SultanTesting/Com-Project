<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait imageTrait {

    public function uploadImages(Request $request, $inputName, $directory)
    {
        if($request->hasFile($inputName))
        {
            $random = substr(md5(mt_rand()), 0, 6);
            $image = $request->{$inputName};
            $imageName = date("Y-m-d") . '_' . rand(255,20000) . $random . uniqid() . '.' . $image->extension();
            $image->move(public_path($directory), $imageName);

            return $directory.'/'.$imageName;
        }
    }
}
