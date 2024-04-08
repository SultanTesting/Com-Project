<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductVariants;
use App\Models\ProductVariantItem;
use App\Http\Controllers\Controller;
use App\DataTables\ProductVariantItemDataTable;

class variantItemController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(ProductVariantItemDataTable $dataTable)
    {
        $variant = ProductVariants::findOrFail(request()->variantId);
        $product = Product::findOrFail(request()->productId);
        return $dataTable->render('admin.products.variants.item.index', compact(['variant', 'product']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $variant = ProductVariants::findOrFail($request->variant);
        return view('admin.products.variants.item.create', compact('variant'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'product_variants_id' => ['required' ,'integer', 'exists:product_variants,id'],
            'name' => ['required', 'min:2', 'max:30'],
            'price' => ['required', 'integer', 'min:0'],
            'default' => ['required'],
            'status' => ['required']
        ]);

        ProductVariantItem::create($request->all());

        return redirect()->route('admin.product.variant-item.index',
        ['productId' => $request->product, 'variantId' => $request->product_variants_id])
            ->with('message', __('Created', ['name' => $request->name]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductVariantItem $item)
    {
        return view('admin.products.variants.item.edit', compact(['item']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductVariantItem $item)
    {

        // dd($request->all());
        $request->validate([
            'name' => ['required', 'min:2', 'max:30'],
            'price' => ['required', 'integer', 'min:0'],
            'default' => ['required'],
            'status' => ['required']
        ]);

        $item->update($request->all());

        return redirect()->route('admin.product.variant-item.index',
         ['productId' => $request->product, 'variantId' => $request->variant])
            ->with('message', __('Updated', ['name' => $item->name]));
    }

    public function changeStatus(Request $request)
    {
        $item = ProductVariantItem::findOrFail($request->id);
        changeStatus($item, $request);

        return response(['status' => 'success', 'message' => __('Status Changed')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductVariantItem $item)
    {
        $item->delete();

        return response(['status' => 'success', 'message' => __('Deleted', ['name' => $item->name])]);
    }
}
