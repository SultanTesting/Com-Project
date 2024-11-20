<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\DataTables\Vendor\VendorOrdersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;


class VendorOrdersController extends Controller
{
    public function index(VendorOrdersDataTable $dataTable)
    {
        return $dataTable->render('vendor.orders.index');
    }

    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        $address = json_decode($order->order_address);
        $shipping = json_decode($order->shipping_method);
        $filter = ['order_id' => $id, 'vendor_id' => auth()->user()->vendor->id];
        $products = OrderProduct::where($filter)->get();
        $total = 0;

        foreach ($products as $unit) {
            $total += $unit->unit_price * $unit->qty;
        }

        $orderProducts = OrderProduct::where($filter)->first();

        return view('vendor.orders.show', compact(['order', 'address', 'shipping', 'orderProducts', 'total']));
    }

    public function status(Request $request)
    {
        $filter = ['order_id' => $request->id, 'vendor_id' => auth()->user()->vendor->id];
        $orders = OrderProduct::where($filter)->get();

        foreach ($orders as $order) {
            $order->vendor_order_status = $request->status;
            $order->save();
        }

        return response(['status' => 'success', 'message' => __('Success')]);
    }
}
