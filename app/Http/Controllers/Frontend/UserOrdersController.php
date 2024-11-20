<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\UserOrdersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class UserOrdersController extends Controller
{
    public function index(UserOrdersDataTable $dataTable)
    {
        return $dataTable->render('frontend.dashboard.sections.orders.index');
    }

    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        $address = json_decode($order->order_address);
        $coupon = json_decode($order->coupon);
        $shipping = json_decode($order->shipping_method);
        return view('frontend.dashboard.sections.orders.show', compact(['order', 'address', 'coupon', 'shipping']));
    }
}
