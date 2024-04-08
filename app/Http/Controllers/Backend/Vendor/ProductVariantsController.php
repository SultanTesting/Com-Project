<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductVariants;
use App\Models\ProductVariantItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\DataTables\Vendor\ProductVariantsDataTable;

class ProductVariantsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ProductVariants::class, 'variant');
    }

    public function index(ProductVariantsDataTable $dataTable, Request $request)
    {
        $product = Product::findOrFail($request->product);

        // if(Auth::user()->vendor->id !== $product->vendor_id)
        // {
        //     abort(404);
        // }

        return $dataTable->render('vendor.products.variants.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $product = Product::findOrFail($request->product);
        return view('vendor.products.variants.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:2', 'max:30'],
            'status' => ['required'],
            'product_id' => ['required', 'exists:products,id']
        ]);

        $request['name'] = strtolower(Str::plural($request->name));

        ProductVariants::create($request->all());

        return redirect()->route('vendor.variants.index', ['product' => $request->product_id])
                        ->with('message', __('Created', ['name' => $request->name]));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductVariants $variant)
    {
        return view('vendor.products.variants.edit', compact('variant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductVariants $variant)
    {
        $request->validate([
            'name' => ['required', 'min:2', 'max:30', 'unique:product_variants,name,' . $request->id],
            'status' => ['required']
        ]);

        if(Auth::user()->vendor->id !== $variant->product->vendor_id)
        {
            abort(404);
        }

        $request['name'] = strtolower(Str::plural($request->name));

        $variant->update($request->all());

        return redirect()->route('vendor.variants.index', ['product' => $variant->product_id])
                        ->with('message', __('Updated', ['name' => $variant->name]));

    }

    public function changeStatus(Request $request)
    {
        $variant = ProductVariants::findOrFail($request->id);
        changeStatus($variant, $request);

        return response(['status' => 'success', 'message' => __('Status Changed')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductVariants $variant)
    {
        $items = ProductVariantItem::where('product_variants_id', $variant->id)->count();

        // if(Auth::user()->vendor->id !== $variant->product->vendor_id)
        // {
        //     abort(404);
        // }

        return protectWrongDelete($items, $variant, 'Variant');
    }
}
