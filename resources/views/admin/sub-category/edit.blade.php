@extends('admin.layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Sub-Category</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Manage Categories</a></div>
            <div class="breadcrumb-item">Edit</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12 col-xl-12 col-md-6">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h4>Edit [ {{$subCategory->name}}  ]</h4>
                    </div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('admin.sub-category.update', $subCategory->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Sub-Category Name</label>
                                <input type="text" class="form-control" name="name" value="{{$subCategory->name}}">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Category</label>
                                <select name="category_id" class="form-control">
                                    <option value="{{$subCategory->id}}" selected></option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option {{$subCategory->status == 'Active' ? 'selected' : ''}}
                                    value='Active'>
                                    Active
                                </option>
                                <option {{$subCategory->status == 'Inactive' ? 'selected' : ''}}
                                    value='Inactive'>
                                    Inactive
                                </option>
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
