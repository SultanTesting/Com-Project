<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSettings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $generalSet = GeneralSettings::first();
        return view('admin.settings.index', compact('generalSet'));
    }

    public function generalSettingsUpdate(Request $request)
    {
        $request->validate([
            'site_name' => ['required', 'string', 'max:150'],
            'contact_email' => ['required', 'email'],
            'layout' => ['required', 'string'],
            'currency_name' => ['required'],
            'currency_icon' => ['required'],
            'timezone' => ['required']
        ]);

        GeneralSettings::updateOrCreate(
            ['id' => 1],
            $request->all()
        );

        return back()->with('success', __('Success'));
    }
}
