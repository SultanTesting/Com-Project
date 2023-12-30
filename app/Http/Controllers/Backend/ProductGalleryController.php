<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductGalleryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductGalleryRequest;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Traits\imageTrait;
use Illuminate\Http\Request;

class ProductGalleryController extends Controller
{
    use imageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $images = ProductGallery::where('product_id', $request->product)->get();
        $product = Product::findOrFail($request->product);

        return view('admin.products.gallery.index', compact(['product', 'images']));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductGalleryRequest $request)
    {
        $imagePaths = $this->uploadMultiImages($request, 'images', makeDirectory('products', $request->name));

        foreach($imagePaths as $path)
        {
            $gallery = new ProductGallery();
            $gallery->images = $path;
            $gallery->product_id = $request->product_id;

            $gallery->save();
        }

        return back()->with('message', __('Created', ['name' => __('Image')]));
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $image = ProductGallery::findOrFail($id);
        $this->deleteImage($image->images, 'products', $request->name);
        $image->delete();

        return response(['status' => 'success', 'message' => __('Deleted', ['name' => __('Image')])]);
    }
}
