<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;
use App\DataTables\vendorProductDataTable;

class VendorProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(vendorProductDataTable $dataTable)
    {
        return $dataTable->render('vendor.products.index');
    }

    public function getSubCategories(Request $request)
    {
        $values = ['category_id' => $request->id, 'status' => 'Active'];
        $subCategories = SubCategory::where($values)->get();

        return $subCategories;
    }

    public function getChildCategories(Request $request)
    {
        $values = ['sub_category_id' => $request->id, 'status' => 'Active'];
        $childCategories = ChildCategory::where($values)->get();

        return $childCategories;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::where('status', 'active')->get();
        return view('vendor.products.create', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request, Product $product)
    {
        // dd($request->all());

        Product::create($request->getData($product));

        return redirect()->route('vendor.products.index')
                ->with('message', __('Created', ['name' => __('Product')]));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

        //** Check if user is the owner of product */
        if($product->vendor_id !== Auth::user()->vendor->id)
        {
            abort(404);
        }

        $subCategories = SubCategory::where('category_id', $product->category_id)->get();
        $childCategories = ChildCategory::where('sub_category_id', $product->sub_category_id)->get();
        $brands = Brand::all();
        return view('vendor.products.edit', compact(['product', 'subCategories', 'childCategories', 'brands']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        //** Check if user is the owner of product */
        if($product->vendor_id !== Auth::user()->vendor->id)
        {
            abort(404);
        }

        $product->update($request->getData($product));

        return redirect()->route('vendor.products.index')
                    ->with('message', __('Updated', ['name' => $product->name]));
    }

    public function changeStatus(Request $request)
    {
        $product = Product::findOrFail($request->id);
        changeStatus($product, $request);

        return response(['status' => 'success', 'message' => __('Status Changed')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
