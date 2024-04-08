<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VendorProfileController extends Controller
{

    public function index()
    {
        return view('vendor.dashboard.sections.profile');
    }

    public function updateProfile(ProfileRequest $request, User $user)
    {

        // dd($request->all());

        $request->user()->update($request->getData($user));

        return back()->with('message', __('Updated', ['name' => $request->name]));
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

        return back()->with('message', __('Updated', ['name' => __('Password')]));
    }
}
