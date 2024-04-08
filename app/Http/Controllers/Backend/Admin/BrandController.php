<?php

namespace App\Http\Controllers\Backend\Admin;

use App\DataTables\BrandDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Models\Product;
use App\Traits\imageTrait;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    use imageTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(BrandDataTable $dataTable)
    {
        return $dataTable->render('admin.categories.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request, Brand $brand)
    {

        // dd($request->all());
        Brand::create($request->getData($brand));

        return redirect()->route('admin.brand.index')
        ->with('message', __('Created', ['name' => __('Brand')]));
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
    public function edit(Brand $brand)
    {
        return view('admin.categories.brand.edit', compact('brand'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        // dd($request->all());

        $brand->update($request->getData($brand));

        return redirect()->route('admin.brand.index')
        ->with('message', __('Updated', ['name' => $brand->name]));
    }

    public function changeStatus(Request $request)
    {
        $brand = Brand::findOrFail($request->id);
        changeStatus($brand, $request);

        return response(['status' => 'success', 'message' => 'Status Changed !']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $this->deleteImage($brand->logo, 'brands', $brand->name);

        $products = Product::where('brand_id', $brand->id)->count();

        if($products > 0)
        {
            return response(['status' => 'error',
            'message' => __('Cannot Delete This Brand, Delete Products First!')]);
        }

        $brand->delete();

        return response(['status' => 'success', 'message' => __('Deleted', ['name' => $brand->name])]);

    }
}
