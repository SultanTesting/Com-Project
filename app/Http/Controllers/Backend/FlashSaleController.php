<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\Admin\FlashProductsDataTable;
use App\DataTables\FlashSaleItemDataTable;
use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FlashSaleItemDataTable $dataTable)
    {
        $flash = FlashSale::first();
        return $dataTable->render('admin.website.flash-sale.index', compact('flash'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(FlashProductsDataTable $dataTable)
    {
        $flash = FlashSale::first();
        $vendors = Vendor::where('store_status', 'open')->get();
        return $dataTable->render('admin.website.flash-sale.create', compact(['flash','vendors']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if($request->product_id)
        {
            $request->validate([
                'product_id' => ['required', 'exists:products,id']
            ],[
                'product_id' => 'Product'
            ]);

            // Change Product Flash Status To Yes
            $product = Product::find($request->product_id);
            $product->flash = 'yes';
            $product->save();

            // Add Product To Flash Item Table
            FlashSaleItem::create($request->all());

            return response(['status' => 'success', 'message' => 'Done']);
        }

        if($request->vendor_id)
        {
            $request->validate([
                'vendor_id' => ['required', 'exists:vendors,id']
            ],[
                'vendor_id' => 'Vendor'
            ]);

            $matchValues = ['vendor_id' => $request->vendor_id, 'flash' => 'no' ];
            $products = Product::where($matchValues)->get();

            if($products->count() == 0)
            {
                return back()->with('warning', 'Vendor Products Already Added To Flash Sale !');
            }

            foreach ($products as $product) {
                $flash = new FlashSaleItem();
                $flashProduct = Product::find($product->id);

                $flash->product_id = $product->id;
                $flashProduct->flash = 'yes';

                $flash->save();
                $flashProduct->save();
            }

            return back()->with('message', 'Data Saved');
        }

        if($request->home_id)
        {
            // dd($request->all());

            $request->validate([
                'home_id' => ['exists:flash_sale_items,id']
            ],[
                'home_id' => 'Show At Home Feature'
            ]);

            $flash = FlashSaleItem::find($request->home_id);

            $flash->show_at_front = ($request->value === 'yes') ? 'yes' : 'no';

            $flash->save();

            return response(['status' => 'success', 'message' => __('Status Changed')]);

        }


        $request->validate([
            'end_date' => ['required']
        ]);

        FlashSale::updateOrCreate(
            ['id' => 1],
            ['end_date' => $request->end_date]
        );

        return back()->with('success', __('Success'));
    }

    public function changeStatus(Request $request)
    {
        $flash = FlashSaleItem::find($request->id);
        changeStatus($flash, $request);

        return response(['status' => 'success', 'message' => 'Status Changed !']);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find(request()->product);
        $product->flash = 'no';
        $product->save();

        $item = FlashSaleItem::find($id);
        $item->delete();

        return response(['status' => 'success', 'message' => __('Deleted', ['name' => $item->product->name])]);
    }

    public function clearAll(Request $request)
    {
        $flashItems = FlashSaleItem::all();

        foreach($flashItems as $item)
        {
            $product = Product::find($item->product_id);
            $product->flash = 'no';

            $product->save();
            $item->delete();
        }

        return response(['status' => 'success', 'message' => 'All Items Deleted']);

    }
}
