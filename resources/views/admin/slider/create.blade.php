@extends('admin.layouts.main')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{__('Add New', ['name' => __('Slider')])}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('Dashboard')}}</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.slider.index') }}">{{__('Manage Website')}}</a></div>
                <div class="breadcrumb-item">{{__('Create')}}</div>
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
                            <h4>{{__('Create New', ['name' => __('Slider')])}}</h4>
                        </div>

                        <div class="card-body">

                            <form method="POST" action="{{ route('admin.slider.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3 form-group">
                                    <label for="formFileMultiple" class="form-label">{{__('Upload Files')}}</label>
                                    <input class="form-control" name="banner" type="file" id="formFileMultiple"
                                        multiple>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('Type')}}</label>
                                    <input type="text" name="type" value="{{old('type')}}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>{{__('Title')}}</label>
                                    <input type="text" name="title" value="{{old('title')}}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>{{__('Starting Price')}} </label>
                                    <input type="text" name="starting_price" value="{{old('starting_price')}}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>{{__('Serial Number')}}</label>
                                    <input type="text" name="serial" value="{{old('serial')}}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>{{__('Url')}}</label>
                                    <input type="text" name="url" value="{{old('url')}}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label class="form-lab">{{__('Status')}}</label>
                                    <select class="form-control" aria-label="Default select example"
                                    name="status" value="{{old('status')}}">
                                        <option value="Active">{{__('Active')}}</option>
                                        <option value="Inactive">{{__('Inactive')}}</option>
                                    </select>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-outline-primary btn-lg btn-block">{{__('Create')}}</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection
