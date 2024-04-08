<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\DataTables\Vendor\ProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariantItem;
use App\Models\ProductVariants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductVariantItemController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(ProductVariantItem::class, 'item');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(ProductVariantItemDataTable $dataTable)
    {
        $product = Product::findOrFail(request()->product);
        $variant = ProductVariants::findOrFail(request()->variant);

        return $dataTable->render('vendor.products.variants.item.index', compact(['product', 'variant']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $variant = ProductVariants::findOrFail(request()->variant);
        return view('vendor.products.variants.item.create', compact('variant'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ProductVariantItem $item)
    {
        // dd($request->all());
        $request->validate([
            'product_variants_id' => ['required', 'exists:product_variants,id'],
            'name' => ['required', 'min:2', 'max:30', 'unique:product_variant_items,name,'],
            'price' => ['required', 'integer', 'min:0'],
            'default' => ['required'],
            'status' => ['required']
        ]);

        ProductVariantItem::create($request->all());

        return redirect()->route('vendor.item.index',
        ['product' => $request->product, 'variant' => $request->product_variants_id])
                        ->with('message', __('Created', ['name' => $request->name]));

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
    public function edit(ProductVariantItem $item)
    {
        return view('vendor.products.variants.item.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductVariantItem $item)
    {
        $request->validate([
            'name' => ['required', 'min:2', 'max:30', 'unique:product_variant_items,name,' . $item->id],
            'price' => ['required', 'integer', 'min:0'],
            'default' => ['required'],
            'status' => ['required']
        ]);

        $item->update($request->all());

        return redirect()->route('vendor.item.index',
        ['product' => $request->product, 'variant' => $request->variant])
                        ->with('message', __('Updated', ['name' => $request->name]));
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
