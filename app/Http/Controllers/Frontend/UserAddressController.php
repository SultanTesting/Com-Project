<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAddressRequest;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userAddress = UserAddress::where('user_id', Auth::user()->id)->get();
        return view('frontend.dashboard.sections.address.index', compact('userAddress'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.dashboard.sections.address.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserAddressRequest $request)
    {
        // dd($request->all());

        UserAddress::create($request->getData());

        return redirect()->route('user.address.index')->with('success', __('Address Added Successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $address = UserAddress::findOrFail($id);
        return view('frontend.dashboard.sections.address.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserAddressRequest $request, string $id)
    {
        $address = UserAddress::findOrFail($id);

        $address->update($request->getData());

        return redirect()->route('user.address.index')->with('success', __('Updated', ['name' => $address->name]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $address = UserAddress::findOrFail($id);

        $address->delete();

        return response(['status' => 'success', 'message' => __('Deleted', ['name' => $address->name])]);
    }
}
