<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait imageTrait {

    public function uploadImages(Request $request, $inputName, $directory, $oldPath = null)
    {
        if($request->hasFile($inputName))
        {

            if(File::exists(public_path($oldPath)))
            {
                File::delete(public_path($oldPath));
            }

            $random = substr(md5(mt_rand()), 0, 6);
            $image = $request->{$inputName};
            $imageName = date("Y-m-d") . '_' . rand(255,20000) . $random . uniqid() . '.' . $image->extension();
            $image->move(public_path($directory), $imageName);

            return $directory.'/'.$imageName;
        }
    }

    public function deleteImage($path)
    {
        if(File::exists(public_path($path)))
        {
            File::delete(public_path($path));
        }
    }
}
