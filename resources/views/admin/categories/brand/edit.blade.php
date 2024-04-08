@extends('admin.layouts.main')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{__('Edit Brand')}}</h1>
            <div class="breadcrumb section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                    {{__('Dashboard')}}
                </a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.brand.index') }}">
                    {{__('Manage Products')}}
                </a></div>
                <div class="breadcrumb-item">{{__('Edit', ['name' => __('Brand')])}}</div>
            </div>
        </div>

        <div class="section-body">


            <div class="mb-4">
                <x-back-arrow :href='route("admin.brand.index")'/>
            </div>

            <div class="row">
                <div class="col-12 col-xl-12 col-md-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h4>{{__('Edit', ['name' => $brand->name])}}</h4>
                        </div>

                        <div class="card-body">

                            <form method="POST" action="{{ route('admin.brand.update', $brand->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                @if ($brand->logo)
                                    <div class="form-group">
                                        <img src="{{asset($brand->logo)}}" class="img-thumbnail" width="200px"/>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="logo">{{__('Logo')}}</label>
                                    <input type="file" name="logo" class="form-control">
                                    <x-input-error :messages="$errors->get('logo')" class="alert-danger mb-2"/>
                                </div>

                                <div class="form-group">
                                    <label for="name">{{__('Brand Name')}}</label>
                                    <input type="text" class="form-control" name="name" value="{{$brand->name}}">
                                    <x-input-error :messages="$errors->get('name')" class="alert-danger mb-2"/>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="featured">{{__('featured')}}</label>
                                    <select name="featured" class="form-control">
                                        <option disabled selected>{{__('Select')}}</option>
                                        <option {{$brand->featured == 'Yes' ? 'selected' : ''}}
                                        value="Yes">
                                            {{__('Yes')}}
                                        </option>
                                        <option {{$brand->featured == 'No' ? 'selected' : ''}}
                                        value="No">
                                            {{__('No')}}
                                        </option>
                                    </select>
                                    <x-input-error :messages="$errors->get('featured')" class="alert-danger mb-2"/>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('Status')}}</label>
                                    <select name="status" class="form-control">
                                        <option disabled selected>{{__('Select')}}</option>
                                        <option {{$brand->status == 'Active' ? 'selected' : ''}}
                                            value='Active'>
                                            {{__('Active')}}
                                        </option>
                                        <option {{$brand->status == 'Inactive' ? 'selected' : ''}}
                                            value='Inactive'>
                                            {{__('Inactive')}}
                                        </option>
                                    </select>
                                    <x-input-error :messages="$errors->get('status')" class="alert-danger mb-2"/>
                                </div>


                                <div class="mt-4">
                                    <button type="submit" class="btn btn-outline-primary btn-lg btn-block">
                                        {{__('Update', ['name' => __('Brand')])}}
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
