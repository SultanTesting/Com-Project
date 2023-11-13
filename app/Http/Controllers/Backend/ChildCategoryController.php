<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Http\Controllers\Controller;
use App\DataTables\ChildCategoryDataTable;
use App\Http\Requests\ChildCategoryRequest;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ChildCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.child-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 'Active')->get();
        return view('admin.child-category.create', compact('categories'));
    }

    /**
     * Show the sub-categories data for creating a new child-category.
     */
    public function getSubCategories(Request $request)
    {
        $matchValues = ['category_id' => $request->id, 'status' => 'Active'];
        $subCategories = SubCategory::where($matchValues)->get();

        return $subCategories;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChildCategoryRequest $request)
    {
        // dd($request->all());

        ChildCategory::create($request->getData());

        return redirect()->route('admin.child-category.index')->with('message', 'Child Category Created');
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
    public function edit(ChildCategory $childCategory)
    {
        $category = Category::all();
        $subCategory = SubCategory::where('category_id', $childCategory->category_id)->get();
        return view('admin.child-category.edit', compact(['childCategory', 'category', 'subCategory']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ChildCategory $childCategory)
    {
        // dd($request->all());

        $request->validate([
            'category_id'     => ['required', 'exists:categories,id'],
            'sub_category_id' => ['required', 'exists:sub_categories,id'],
            'name'            => ['required', 'min:3', 'max:25', 'unique:child_categories,name,' . $childCategory->id],
            'slug'            => ['string'],
            'status'          => ['required'],
        ]);

        $childCategory->slug = Str::slug($request->name, '-');
        $childCategory->update($request->all());

        return redirect()->route('admin.child-category.index')->with('message', 'Child Category Updated');
    }

    public function changeStatus(Request $request)
    {
        $childCategory = ChildCategory::findOrFail($request->id);
        $childCategory->status = ($request->status == 'true') ? 'Active' : 'Inactive';
        $childCategory->save();

        return response(['status' => 'success', 'message' => 'Status Changed !']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChildCategory $childCategory)
    {
        $childCategory->delete();

        return response(['status' => 'success', 'message' => 'Child Category Deleted!']);
    }
}
