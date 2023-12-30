@extends('admin.layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{__('Edit', ['name' => __('Sub-Category')])}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('Dashboard')}}</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">{{__('Manage Categories')}}</a></div>
            <div class="breadcrumb-item">{{__('Edit', ['name' => __('Sub-Category')])}}</div>
        </div>
    </div>

    <div class="section-body">

        <div class="mb-4">
            <x-back-arrow :href='route("admin.sub-category.index")'/>
        </div>

        <div class="row">
            <div class="col-12 col-xl-12 col-md-6">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h4>{{__('Edit', ['name' => ''])}} [ <code>{{$subCategory->name}}</code>  ]</h4>
                    </div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('admin.sub-category.update', $subCategory->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">{{__('Name')}}</label>
                                <input type="text" class="form-control" name="name" value="{{$subCategory->name}}">
                            </div>

                            <div class="form-group">
                                <label class="form-label">{{__('Category')}}</label>
                                <select name="category_id" class="form-control">
                                    @foreach ($categories as $category)
                                        <option {{$category->id == $subCategory->category_id ? 'selected' : ''}}
                                        value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">{{__('Status')}}</label>
                                <select name="status" class="form-control">
                                    <option {{$subCategory->status == 'Active' ? 'selected' : ''}}
                                        value='Active'>
                                        {{__('Active')}}
                                    </option>
                                    <option {{$subCategory->status == 'Inactive' ? 'selected' : ''}}
                                        value='Inactive'>
                                        {{__('Inactive')}}
                                    </option>
                                </select>
                            </div>


                            <div class="mt-4">
                                <button type="submit" class="btn btn-outline-primary btn-lg btn-block">
                                    {{__('Update', ['name' => __('Sub-Category')])}}
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
