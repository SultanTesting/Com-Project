@extends('admin.layouts.main')

@section('content')
<section class="section">

    <div class="section-header">

        <h1>{{__('Edit Category')}}</h1>

        <div class="breadcrumb section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                {{__('Dashboard')}}
            </a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">
                {{__('Manage Website')}}
            </a></div>
            <div class="breadcrumb-item">{{__('Edit', ['name' => __('Category')])}}</div>
        </div>

    </div>

    <div class="section-body">

        <div class="mb-4">
            <x-back-arrow :href='route("admin.category.index")'/>
        </div>

        <div class="row">
            <div class="col-12 col-xl-12 col-md-6">
                <div class="card">

                    <div class="card-header justify-content-between">
                        <h4>{{__('Edit', ['name' => __('Category')])}} [ <code>{{$category->name}}</code> ]</h4>
                    </div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('admin.category.update', $category->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @if ($category->icon)
                                <div class="form-group">
                                    <i class="{{$category->icon}} img-thumbnail icon" style='font-size: 55px'></i>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="icon" class="form-label">{{__('Category Icon')}}</label>
                                <button name="icon"
                                class="btn btn-primary btn-block" data-placement="bottom" data-icon="{{$category->icon}}" data-unselected-class="btn-info" role="iconpicker"></button>
                            </div>

                            <div class="form-group">
                                <label for="name">{{__('Category Name')}}</label>
                                <input type="text" class="form-control" name="name" value="{{$category->name}}">
                                <x-input-error :messages="$errors->get('name')" class="alert-danger mb-2"/>
                            </div>

                            <div class="form-group">
                                <label class="form-label">{{__('Status')}}</label>
                                <select name="status" class="form-control">
                                    <option selected disabled>{{__('Select')}}</option>
                                    <option {{$category->status == 'Active' ? 'selected' : ''}}
                                        value='Active'>
                                        {{__('Active')}}
                                    </option>
                                    <option {{$category->status == 'Inactive' ? 'selected' : ''}}
                                        value='Inactive'>
                                        {{__('Inactive')}}
                                    </option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="alert-danger mb-2"/>
                            </div>


                            <div class="mt-4">
                                <button type="submit" class="btn btn-outline-primary btn-lg btn-block">
                                    {{__('Update', ['name' => __('Category')])}}
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
