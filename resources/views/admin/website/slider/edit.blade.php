@extends('admin.layouts.main')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>{{ __('Edit', ['name' => __('Slider')]) }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('Dashboard')}}</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.slider.index') }}">{{__('Manage Website')}}</a></div>
            <div class="breadcrumb-item">{{__('Slider')}}</div>
        </div>
    </div>

    <div class="section-body">

        <div class="mb-4">
            <x-back-arrow :href='route("admin.slider.index")'/>
        </div>

        <div class="row">
            <div class="col-12 col-xl-12 col-md-6">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h4>{{__('Edit', ['name' => $slider->title])}}</h4>
                    </div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('admin.slider.update', $slider->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @if ($slider->banner)
                                <div class="form-group">
                                    <label class="form-label">{{__('Image Preview')}}</label>
                                        <img src="{{ asset($slider->banner) }}" width="250px"
                                        class="rounded img-thumbnail d-block">
                                </div>
                            @endif

                            <div class="mb-3 form-group">
                                <label for="formFileMultiple" class="form-label">{{__('Upload Files')}}</label>
                                <input class="form-control" name="banner" type="file" id="formFileMultiple"
                                    multiple>
                            </div>

                            <div class="form-group">
                                <label class="form-label">{{__('Type')}}</label>
                                <input type="text" name="type" value="{{$slider->type}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>{{__('Title')}}</label>
                                <input type="text" name="title" value="{{$slider->title}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>{{__('Starting Price')}} $</label>
                                <input type="text" name="starting_price" value="{{$slider->starting_price}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>{{__('Serial Number')}}</label>
                                <input type="text" name="serial" value="{{$slider->serial}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>{{__('Url')}}</label>
                                <input type="text" name="url" value="{{$slider->url}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>{{__('Status')}}</label>
                                <select class="form-control" name="status">
                                    <option {{$slider->status == 'Active' ? 'selected' : ''}}
                                        value="Active">{{__('Active')}}</option>
                                    <option {{$slider->status == 'Inactive' ? 'selected' : ''}}
                                        value="Inactive">{{__('Inactive')}}</option>
                                </select>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-outline-primary btn-lg btn-block">
                                    {{__('Update', ['name' => __('Slider')])}}
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


</section>

@endsection
