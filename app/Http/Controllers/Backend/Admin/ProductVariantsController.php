<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductVariants;
use App\Models\ProductVariantItem;
use App\Http\Controllers\Controller;
use App\DataTables\ProductVariantsDataTable;

class ProductVariantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ProductVariantsDataTable $dataTable)
    {
        $product = Product::findOrFail($request->product);
        return $dataTable->render('admin.products.variants.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $product = Product::findOrFail($request->product);
        return view('admin.products.variants.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:2'],
            'status' => ['required'],
            'product_id' => ['required', 'exists:products,id']
        ]);

        $request['name'] = strtolower(Str::plural($request->name));

        ProductVariants::create($request->all());

        return redirect()->route('admin.product-variants.index', ['product' => $request->product_id])
        ->with('message', __('Created', ['name' => __('Variants')]));
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
    public function edit(string $id)
    {
        $variant = ProductVariants::findOrFail($id);
        return view('admin.products.variants.edit', compact('variant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'min:2'],
            'status' => ['required'],
        ]);

        $variant = ProductVariants::findOrFail($id);

        $request['name'] = strtolower(Str::plural($request->name));

        $variant->update($request->all());

        return redirect()->route('admin.product-variants.index', ['product' => $variant->product_id])
        ->with('message', __('Updated', ['name' => __('Variants')]));
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
    public function destroy(string $id)
    {
        $variant = ProductVariants::findOrFail($id);

        $items = ProductVariantItem::where('product_variants_id', $variant->id)->count();

        return protectWrongDelete($items, $variant, 'Variant');

    }
}
