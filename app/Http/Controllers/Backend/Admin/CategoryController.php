<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\CategoryDataTable;
use App\Http\Requests\CategoryRequest;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.categories.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        // dd($request->all());

        Category::create($request->getData());

        return redirect()->route('admin.category.index')
        ->with('message', __('Created', ['name' => __('Category')]));
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
    public function edit(Category $category)
    {
        return view('admin.categories.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        // dd($request->all());

        $category->update($request->getData());

        return redirect()->route('admin.category.index')
        ->with('message', __('Updated', ['name' => $category->name]));
    }

    public function changeStatus(Request $request)
    {
        // dd($request->all());
        $category = Category::findOrFail($request->id);
        changeStatus($category, $request);

        return response(['status' => 'success', 'message' => __('Status Changed')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //! Protecting categories from wrong actions!

        $subCategory = SubCategory::where('category_id', $category->id)->count();

        if($subCategory > 0)
        {
            return response(['status' => 'error',
            'message' => __('Cannot Delete This Category, Delete Sub Items First!')]);
        }

            $category->delete();

        return response(['status' => 'success', 'message' => __('Deleted', ['name' => $category->name])]);
    }
}
