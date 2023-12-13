<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use App\Traits\imageTrait;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use imageTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable)
    {
        $data = Slider::latest()->paginate(10)->withQueryString();
        return $dataTable->render('admin.slider.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request, Slider $slider)
    {
        // dd($request->all());

        Slider::create($request->getData($slider));


        return redirect()->route('admin.slider.index')
            ->with('message', __('Created', ['name' => __('Slider')]));



    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        return view('admin.slider.show', compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', compact('slider'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderRequest $request, Slider $slider)
    {
        // dd($request->all());

        $slider->update($request->getData($slider));

        return redirect()->route('admin.slider.index')
               ->with('message' , __('Updated', ['name' => $slider->title]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {

        $this->deleteImage($slider->banner);
        $slider->delete();

        return response(['status' => 'success', 'message' => __('Deleted', ['name' => $slider->title])]);
    }
}
