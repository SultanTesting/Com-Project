<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Http\Controllers\Controller;
use App\DataTables\SubCategoryDataTable;
use App\Http\Requests\SubCategoryRequest;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.categories.sub-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.sub-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
    */
    public function store(SubCategoryRequest $request)
    {
        SubCategory::create($request->getData());

        return redirect()->route('admin.sub-category.index')
            ->with('message', __('Created', ['name' => __('Sub-Category')]));
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
    public function edit(SubCategory $subCategory)
    {
        $categories = Category::all();
        return view('admin.categories.sub-category.edit', compact(['subCategory', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubCategoryRequest $request, SubCategory $subCategory)
    {
        $subCategory->update($request->getData());

        return redirect()->route('admin.sub-category.index')
            ->with('message', __('Updated', ['name' => $subCategory->name]));
    }

    public function changeStatus(Request $request)
    {
        $subCategory = SubCategory::findOrFail($request->id);
        changeStatus($subCategory, $request);

        return response(['status' => 'success', 'message' => __('Status Changed')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        //! Protecting SubCategories from wrong actions!

        $childCategory = ChildCategory::where('sub_category_id', $subCategory->id)->count();
        if($childCategory > 0)
        {
            return response(['status' => 'error', 'message' => 'Cannot Delete This SubCategory, Delete Childs First']);
        }

        $subCategory->delete();

        return response(['status' => 'success', 'message' => __('Deleted', ['name' => $subCategory->name])]);
    }
}
