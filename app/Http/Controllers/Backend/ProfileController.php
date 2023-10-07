<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }

    public function update(ProfileRequest $request)
    {
        // dd($request->all());

        // $request->validate([
        //     'name' => ['required', 'max:25'],
        //     'email' => ['required', 'email', 'unique:users,email,'.Auth::user()->id]
        // ]);

        // $user = Auth::user();
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->save();

        $user = $request->user();

        if($request->hasFile('image'))
        {
            // Delete Old Photo if exists
            if(File::exists(public_path($user->image)))
            {
                File::delete(public_path($user->image));
            }

            // Upload New One
            $image = $request->image;
            $imageName = date("Y-m-d").rand(255,10000).'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);

            $path = "/uploads/".$imageName;
        }

        $user->fill($request->getData());
        ($request->hasFile('image')) ? ($user->image = $path) : '' ;
        $user->save();


        return redirect()->back()->with('message', 'Updated Successfully!');

    }

    public function updatePassword(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'different:current_password', 'min:6', 'max:25']
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        return back()->with('message', 'Password Updated Successfully!');
    }


}
