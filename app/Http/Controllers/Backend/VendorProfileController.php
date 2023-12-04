<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VendorProfileController extends Controller
{

    public function index()
    {
        return view('vendor.dashboard.sections.profile');
    }

    public function updateProfile(ProfileRequest $request)
    {

        // dd($request->all());

        $user = $request->user();

        if($request->hasFile('image'))
        {
            if(File::exists(public_path($user->image)))
            {
                File::delete(public_path($user->image));
            }

            $image = $request->image;
            $imageName = date("Y-m-d") . rand(500,1200) . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);

            $path = "/uploads/".$imageName;
        }

        $user->fill($request->getData($request));
        ($request->hasFile('image') ? ($user->image = $path) : '');
        $user->save();

        return back()->with('message', __('strings.Updated', ['name' => $request->name]));
    }

    public function updatePassword(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'different:current_password', 'min:6', 'max:30'],
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        return back()->with('message', __('strings.Updated', ['name' => __('strings.Password')]));
    }
}
