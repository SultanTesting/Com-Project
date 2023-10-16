@extends('admin.layouts.main')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Edit Product</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.slider.index') }}">Manage Website</a></div>
            <div class="breadcrumb-item">Edit</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12 col-xl-12 col-md-6">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h4>Edit [ {{$slider->title}} ]</h4>
                    </div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('admin.slider.update', $slider->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @if ($slider->banner)
                                <div class="form-group">
                                    <label class="form-label">Preview</label>
                                        <img src="{{ asset($slider->banner) }}" width="250px"
                                        class="rounded img-thumbnail d-block">
                                </div>
                            @endif

                            <div class="mb-3 form-group">
                                <label for="formFileMultiple" class="form-label">Upload Images</label>
                                <input class="form-control" name="banner" type="file" id="formFileMultiple"
                                    multiple>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Type</label>
                                <input type="text" name="type" value="{{$slider->type}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" value="{{$slider->title}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Starting Price $</label>
                                <input type="text" name="starting_price" value="{{$slider->starting_price}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Serial Number</label>
                                <input type="text" name="serial" value="{{$slider->serial}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Url</label>
                                <input type="text" name="url" value="{{$slider->url}}" class="form-control">
                            </div>

                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option {{$slider->status == 'Active' ? 'selected' : ''}}
                                    value="Active">Active</option>
                                <option {{$slider->status == 'Inactive' ? 'selected' : ''}}
                                    value="Inactive">Inactive</option>
                            </select>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-outline-primary btn-lg btn-block">Update</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


</section>

@endsection
