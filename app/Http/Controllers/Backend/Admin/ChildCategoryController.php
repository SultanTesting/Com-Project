<?php

namespace App\Http\Controllers\Backend\Admin;

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
        return $dataTable->render('admin.categories.child-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 'Active')->get();
        return view('admin.categories.child-category.create', compact('categories'));
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

        return redirect()->route('admin.child-category.index')
        ->with('message', __('Created', ['name' => __('Child-Category')]));
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
        return view('admin.categories.child-category.edit', compact(['childCategory', 'category', 'subCategory']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChildCategoryRequest $request, ChildCategory $childCategory)
    {
        // dd($request->all());

        $childCategory->update($request->getData());

        return redirect()->route('admin.child-category.index')
        ->with('message', __('Updated', ['name' => $childCategory->name]));
    }

    public function changeStatus(Request $request)
    {
        $childCategory = ChildCategory::findOrFail($request->id);
        changeStatus($childCategory, $request);

        return response(['status' => 'success', 'message' => __('Status Changed')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChildCategory $childCategory)
    {
        $childCategory->delete();

        return response(['status' => 'success', 'message' => __('Deleted', ['name' => $childCategory->name])]);
    }
}
