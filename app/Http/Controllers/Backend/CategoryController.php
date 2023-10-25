<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
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
        return $dataTable->render('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        // dd($request->all());

        Category::create($request->getData());

        return redirect()->route('admin.category.index')->with('message', 'New Category Added');
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
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // dd($request->all());

        $request->validate([
                'name'   => ['required', 'string', 'min:2', 'max:20', 'unique:categories,name,' . $category->id],
                'slug'   => ['string'],
                'icon'   => ['required' ,'not_in:empty'],
                'status' =>['required']
        ]);

        $category->slug = Str::slug($request->name, '-');

        $category->update($request->all());

        return redirect()->route('admin.category.index')->with('message', 'Category Edited ! ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.category.index')->with('message', 'Category Deleted Successfully!');
    }
}
