<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorProfileRequest;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendor = Vendor::where('user_id', Auth::user()->id)->first();
        return view('vendor.shop.index', compact('vendor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VendorProfileRequest $request, string $id)
    {
        // dd($request->all());

        $vendor = Vendor::findOrFail($id);

        $vendor->update($request->getData($vendor));

        return back()->with('message', __('Updated', ['name' => __('Vendor Profile')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
