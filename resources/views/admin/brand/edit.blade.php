@extends('admin.layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Brand</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.brand.index') }}">Manage Products</a></div>
            <div class="breadcrumb-item">Edit</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12 col-xl-12 col-md-6">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h4>Edit [ {{$brand->name}} Brand ]</h4>
                    </div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('admin.brand.update', $brand->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @if ($brand->logo)
                                <div class="form-group">
                                    <img src="{{$brand->logo}}" class="img-thumbnail" style="width: 150px"/>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="logo" class="form-label">Upload Logo</label>
                                <input type="file" name="logo" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="name">Brand Name</label>
                                <input type="text" class="form-control" name="name" value="{{$brand->name}}">
                            </div>

                            <label class="form-label" for="featured">Featured</label>
                            <select name="featured" class="form-control">

                                <option {{$brand->featured == 'Yes' ? 'selected' : ''}}
                                 value="Yes">
                                    Yes
                                </option>

                                <option {{$brand->featured == 'No' ? 'selected' : ''}}
                                 value="No">
                                    No
                                </option>

                            </select>

                            <label class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option {{$brand->status == 'Active' ? 'selected' : ''}}
                                    value='Active'>
                                    Active
                                </option>
                                <option {{$brand->status == 'Inactive' ? 'selected' : ''}}
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
