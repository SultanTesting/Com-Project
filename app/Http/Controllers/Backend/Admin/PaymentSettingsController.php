<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymobSettings;
use App\Models\PaypalSettings;
use App\Models\StripeSettings;
use Illuminate\Http\Request;

class PaymentSettingsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $paypal = PaypalSettings::first();
        $stripe = StripeSettings::first();
        $paymob = PaymobSettings::first();
        return view('admin.payment-settings.index', compact(['paypal', 'stripe', 'paymob']));
    }
}
