<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\StripeSettings;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'status' => ['required'],
            'account_mode' => ['required'],
            'country' => ['required', 'string', 'max:200'],
            'currency_name' => ['required', 'string', 'max:200'],
            'currency_icon' => ['required', 'string', 'max:200'],
            'currency_rate' => ['required'],
            'client_id' => ['required'],
            'secret_key' => ['required']
        ]);

        StripeSettings::updateOrCreate(
            ['id' => 1],
            $request->all()
        );

        return back()->with('message', __('Success'));
    }
}
