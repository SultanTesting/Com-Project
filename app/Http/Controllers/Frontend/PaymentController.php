<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GeneralSettings;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PaypalSettings;
use App\Models\Product;
use App\Models\Transaction;
use Gloudemans\Shoppingcart\Facades\Cart;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {

        if(!session()->has(['ship_method', 'ship_address']))
        {
            return redirect()->route('home');
        }

        return view('frontend.pages.payment');
    }

    public function paymentSuccess()
    {
        return view('frontend.pages.payment-success');
    }

    public function storeOrder($paymentMethod, $paymentStatus, $transactionId, $paidAmount)
    {
        /** Start Our Order */
        $settings = GeneralSettings::first();

        $order = new Order();

        $order->invoice_id = (Order::get('invoice_id')->max('invoice_id') + 1);
        $order->user_id = Auth::user()->id;
        $order->sub_total = mainCartTotal();
        $order->amount = session('final_amount')['final_amount'];
        $order->currency_name = $settings->currency_name;
        $order->currency_icon = $settings->currency_icon;
        $order->order_qty = Cart::content()->count();
        $order->payment_method = $paymentMethod;
        $order->payment_status = $paymentStatus;
        $order->shipping_method = json_encode(Session::get('ship_method'));
        $order->order_address = json_encode(Session::get('ship_address'));
        $order->coupon = (Session::has('coupon') ? json_encode(Session::get('coupon')) : 'No Coupon');
        $order->order_status = 0;
        $order->save();

        /** Store Order Products */

        foreach(Cart::content() as $item)
        {
            $product = Product::find($item->id);

            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $item->id;
            $orderProduct->vendor_id = $product->vendor_id;
            $orderProduct->product_name = $item->name;
            $orderProduct->variants = json_encode($item->options->variants);
            $orderProduct->variants_total = $item->options->variants_price;
            $orderProduct->unit_price = $item->price;
            $orderProduct->qty = $item->qty;
            $orderProduct->save();

            $product->quantity = ($product->quantity - $item->qty);
            $product->save();
        }

        /** Store Transaction Details */
        $transaction = new Transaction();
        $transaction->order_id = $order->id;
        $transaction->transaction_id = $transactionId;
        $transaction->payment_method = $paymentMethod;
        $transaction->amount = session('final_amount')['final_amount'];
        $transaction->converted_amount = $paidAmount;
        $transaction->save();

    }

    /** PayPal Functions */

    public function paypalConfig()
    {

        $paypal = PaypalSettings::first();

        $config = [
            'mode'    => $paypal->account_mode,
            'sandbox' => [
                'client_id'     => $paypal->paypal_client_id,
                'client_secret' => $paypal->paypal_sec_key,
                'app_id'        => '',
            ],
            'live' => [
                'client_id'     => $paypal->paypal_client_id,
                'client_secret' => $paypal->paypal_sec_key,
                'app_id'        => '',
            ],

            'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
            'currency'       => 'USD',
            'notify_url'     => '', // Change this accordingly for your application.
            'locale'         => 'en_US', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
            'validate_ssl'   => true, // Validate SSL when creating api client.
            ];

            return $config;
    }

    public function payWithPaypal()
    {
        $config = $this->paypalConfig();
        $paypal = PaypalSettings::first();

        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        $payableAmount = round(session('final_amount')['final_amount'] / $paypal->currency_rate, 2);

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('user.paypal.success'),
                "cancel_url" => route('user.paypal.cancel')
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => 'USD',
                        "value" => $payableAmount
                    ]
                ]
            ]
        ]);

        if(isset($response['id']) && $response['id'] !== null)
        {
            foreach ($response['links'] as $link)
            {
                if($link['rel'] === 'approve')
                {
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('user.paypal.cancel');
        }
    }

    public function paypalSuccess(Request $request)
    {
        $config = $this->paypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if(isset($response['status']) && $response['status'] == 'COMPLETED')
        {
            $paypal = PaypalSettings::first();
            $paidAmount = round(session('final_amount')['final_amount'] / $paypal->currency_rate, 2);

            $this->storeOrder('paypal', 1, $response['id'], $paidAmount);
            Cart::destroy();
            Session::forget(['ship_address', 'coupon', 'ship_method', 'final_amount']);
            return redirect()->route('user.payment.success');
        }

        return redirect()->route('user.paypal.cancel');
    }

    public function paypalCancel()
    {
        return redirect()->route('user.payment')->with('error', 'Something Went Wrong! Payment Declined!');
    }
}
