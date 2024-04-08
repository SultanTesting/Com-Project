<?php

namespace App\Http\Controllers\Backend\Admin;

use App\DataTables\Admin\PendingProductsDataTable;
use App\DataTables\SellersProductsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SellersProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SellersProductsDataTable $dataTable)
    {
        return $dataTable->render('admin.products.seller-products.index');
    }

    public function pendingProducts(PendingProductsDataTable $dataTable)
    {
        return $dataTable->render('admin.products.pending.index');
    }

    public function changeApproved(Request $request)
    {
        // dd($request->value);

        $product = Product::findOrFail($request->id);
        $product->approved = $request->value;
        $product->save();

        return response(['status' => 'success', 'message' => __('Success')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
