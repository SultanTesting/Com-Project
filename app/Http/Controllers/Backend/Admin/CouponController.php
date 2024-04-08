<?php

namespace App\Http\Controllers\Backend\Admin;

use App\DataTables\Admin\CouponDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CouponDataTable $dataTable)
    {
        return $dataTable->render('admin.website.coupon.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.website.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponRequest $request)
    {

        // dd($request->all());
        Coupon::create($request->getData());

        return redirect()->route('admin.coupon.index')->with('success', __('Success'));
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
    public function edit(Coupon $coupon)
    {
        return view('admin.website.coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CouponRequest $request, Coupon $coupon)
    {
        // dd($request->all());

        $coupon->update($request->getData());

        return redirect()->route('admin.coupon.index')->with('success', __('Updated', ['name' => $coupon->name]));
    }

    public function changeStatus(Request $request)
    {
        $coupon = Coupon::findOrFail($request->id);

        changeStatus($coupon, $request);

        return response(['status' => 'success', 'message' => __('Status Changed')]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return response(['status' => 'success', 'message' => __('Deleted', ['name' => $coupon->name])]);
    }
}
