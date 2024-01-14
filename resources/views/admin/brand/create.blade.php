@extends('admin.layouts.main')

@section('content')

    <section class="section">
        <div class="section-header">
            <h1>{{__('Add New Brand')}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                    {{__('Dashboard')}}
                </a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.brand.index') }}">
                    {{__('Manage Products')}}
                </a></div>
                <div class="breadcrumb-item">{{__('Create')}} +</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-xl-12 col-md-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h4>{{__('Create New Brand')}}</h4>
                        </div>

                        <div class="card-body">

                            <form method="POST"
                                action="{{ route('admin.brand.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="name" class="form-label">{{__('Brand Name')}}</label>
                                    <input type="text" class="form-control" name="name" value="{{old('name')}}">
                                    <x-input-error :messages="$errors->get('name')" class="alert-danger mb-2"/>
                                </div>

                                <div class="form-group">
                                    <label for="logo" class="form-label">{{__('Logo')}}</label>
                                    <input type="file" name="logo" class="form-control">
                                    <x-input-error :messages="$errors->get('logo')" class="alert-danger mb-2"/>
                                </div>

                                <div class="form-group">
                                    <label for="featured" class="form-label">{{__('Is Featured')}}</label>
                                    <select name="featured" class="form-control">
                                        <option selected disabled>{{__('Select')}}</option>
                                        <option value="Yes">{{__('Yes')}}</option>
                                        <option value="No">{{__('No')}}</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('featured')" class="alert-danger mb-2"/>
                                </div>

                                <div class="form-group">
                                    <label for="status" class="form-label">{{__('Status')}}</label>
                                    <select name="status" class="form-control">
                                        <option selected disabled>{{__('Select')}}</option>
                                        <option value="Active">{{__('Active')}}</option>
                                        <option value="Inactive">{{__('Inactive')}}</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('status')" class="alert-danger mb-2"/>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-block btn-outline-primary">
                                        {{__('Add New Brand')}}
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
