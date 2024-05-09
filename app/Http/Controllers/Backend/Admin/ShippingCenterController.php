<?php

namespace App\Http\Controllers\Backend\Admin;

use App\DataTables\Admin\ShippingCenterDataTable;
use App\Http\Controllers\Controller;
use App\Models\ShippingCenter;
use Illuminate\Http\Request;

class ShippingCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ShippingCenterDataTable $dataTable)
    {
        return $dataTable->render('admin.website.shipping-center.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.website.shipping-center.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:200'],
            'cost' => ['nullable', 'integer'],
            'type' => ['required', 'in:basic,subscription,min_amount'],
            'min_cost' => ['exclude_unless:type,min_amount', 'required_if:type,min_amount'],
            'status' => ['required']
        ]);

        ShippingCenter::create($request->all());

        return redirect()->route('admin.shipping.index')->with('success', __("Success"));
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
        $shipment = ShippingCenter::findOrFail($id);
        return view('admin.website.shipping-center.edit', compact('shipment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());

        $shipment = ShippingCenter::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:200'],
            'cost' => ['nullable', 'integer'],
            'type' => ['required', 'in:basic,subscription,min_amount'],
            'min_cost' => ['exclude_unless:type,min_amount', 'required_if:type,min_amount'],
            'status' => ['required']
        ]);

        $shipment->update($request->all());

        return redirect()->route('admin.shipping.index')
            ->with('success', __('Updated', ['name' => $shipment->name]));
    }

    public function changeStatus(Request $request)
    {
        $shipment = ShippingCenter::findOrFail($request->id);

        changeStatus($shipment, $request);

        return response(['status' => 'success', 'message' => __('Status Changed')]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shipment = ShippingCenter::findOrFail($id);
        $shipment->delete();

        return response(['status' => 'success', 'message' => __('Deleted', ['name' => $shipment->name])]);
    }
}
