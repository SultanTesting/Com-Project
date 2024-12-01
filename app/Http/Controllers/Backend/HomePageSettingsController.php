<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HomePageSettings;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class HomePageSettingsController extends Controller
{
    public function index()
    {
        $topCategory = json_decode(HomePageSettings::where('key', 'top_categories')->first()->value);
        return view('admin.website.home-page.index', compact(['topCategory']));
    }

    public function topCategories(Request $request)
    {
        $data = [
            [
                'category' => $request->category_1,
                'sub_category' => $request->sub_1,
                'child_category' => $request->child_1
            ],
            [
                'category' => $request->category_2,
                'sub_category' => $request->sub_2,
                'child_category' => $request->child_2
            ],
            [
                'category' => $request->category_3,
                'sub_category' => $request->sub_3,
                'child_category' => $request->child_3
            ],
            [
                'category' => $request->category_4,
                'sub_category' => $request->sub_4,
                'child_category' => $request->child_4
            ],
        ];

        HomePageSettings::updateOrCreate(
            [
                'key' => 'top_categories'
            ],
            [
                'value' => json_encode($data)
            ]
        );

        return back()->with('success', __('Success'));
    }
}
