<?php

namespace App\Http\Controllers\Backend\Admin;

use App\DataTables\OrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render('admin.orders.index');
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
        $order = Order::findOrFail($id);
        $address = json_decode($order->order_address);
        $shipping = json_decode($order->shipping_method);
        $coupon = json_decode($order->coupon);
        return view('admin.orders.show', compact(['order', 'address', 'shipping', 'coupon']));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /** Change Order Status  */
    public function orderStatus(Request $request)
    {
        $order = Order::findOrFail($request->id);

        $order->order_status = $request->status;
        $order->save();

        return response(['status' => 'success', 'message' => __('Status Changed')]);
    }

    /** Change Payment Status */
    public function paymentStatus(Request $request)
    {
        $order = Order::findOrFail($request->id);

        $order->payment_status = $request->status;
        $order->save();

        return response(['status' => 'success', 'message' => __('Status Changed')]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response(['status' => 'success', 'message' => __('Deleted', ['name' => $order->id])]);
    }
}
