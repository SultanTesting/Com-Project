<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaypalSettings;
use Illuminate\Http\Request;

class PaypalController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'status' => ['required'],
            'account_mode' => ['required'],
            'country' => ['required', 'string', 'max:200'],
            'currency_name' => ['required', 'string', 'max:200'],
            'currency_icon' => ['required', 'string', 'max:200'],
            'currency_rate' => ['required'],
            'paypal_client_id' => ['required'],
            'paypal_sec_key' => ['required']
        ]);

        PaypalSettings::updateOrCreate(
            ['id' => 1],
            $request->all()
        );

        return back()->with('message', __('Success'));
    }
}
