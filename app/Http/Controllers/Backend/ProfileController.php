<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProfileRequest;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }

    public function update(ProfileRequest $request, User $user)
    {

        $request->user()->update($request->getData($user));

        return redirect()->back()
        ->with('message', __('Updated', ['name' => $request->name]));

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

        return back()->with('message', __('Updated', ['name' => __('Password')]));
    }


}
