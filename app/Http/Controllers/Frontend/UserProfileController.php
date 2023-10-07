<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        return view('frontend.dashboard.sections.profile');
    }

    public function updateProfile(ProfileRequest $request, User $user )
    {
        $user = $request->user();

        if($request->hasFile('image'))
        {
            if(File::exists(public_path($user->image)))
            {
                File::delete(public_path($user->image));
            }

            $image = $request->image;
            $imageName = date("Y-m-d") . rand(255,10000) . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);

            $path = "/uploads/".$imageName;
        }

        $user->fill($request->getData());
        ($request->hasFile('image') ? ($user->image = $path) : '');
        $user->save();

        return back()->with('message', 'Updated Successfully');
    }

    public function updatePassword(Request $request)
    {

        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'different:current_password', 'min:6', 'max:30']
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        return back()->with('message', 'Password Updated Successfully');
    }
}
