<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SubCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.sub-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.sub-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
    */
    public function store(SubCategoryRequest $request)
    {
        SubCategory::create($request->getData());

        return redirect()->route('admin.sub-category.index')
            ->with('message', 'SubCategory Added');
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
        return view('admin.sub-category.edit', compact(['subCategory', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function changeStatus(Request $request)
    {
        $subCategory = SubCategory::findOrFail($request->id);
        $subCategory->status = ($request->status == 'true') ? 'Active' : 'Inactive';
        $subCategory->save();

        return response(['status' => 'success', 'message' => "Status Changed!"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
