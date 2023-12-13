<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;
use App\Traits\imageTrait;

class ProductController extends Controller
{
    use imageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.products.index');
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
        return view('admin.products.create', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request, Product $product)
    {
        // dd($request->all());

        // dd(Auth::user()->vendor);

        Product::create($request->getData($product));

        return redirect()->route('admin.products.index')
                    ->with('message', __('Created', ['name' => __('Product')]));
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
    public function edit(Product $product)
    {
        $subCategories = SubCategory::where('category_id', $product->category_id)->get();
        $childCategories = ChildCategory::where('sub_category_id', $product->sub_category_id)->get();
        $brands = Brand::all();
        return view('admin.products.edit', compact(['product', 'brands', 'subCategories', 'childCategories']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->getData($product));

        return redirect()->route('admin.products.index')
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
    public function destroy(Product $product)
    {
        $this->deleteImage($product->thumb_image);
        $product->delete();

        return response(['status' => 'success', 'message' => __('Deleted', ['name' => $product->name])]);
    }
}
