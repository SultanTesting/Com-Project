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
        // dd($request->all());

        // $request->validate([
        //     'name' => ['required', 'max:25'],
        //     'email' => ['required', 'email', 'unique:users,email,'.Auth::user()->id]
        // ]);

        // $user = Auth::user();
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->save();

        $request->user()->update($request->getData($request));

        // $user->fill($request->getData($request));
        // ($request->hasFile('image')) ? ($user->image = $path) : '' ;
        // $user->save();


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
