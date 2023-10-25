@extends('admin.layouts.main')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add New Category</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Manage Categories</a></div>
                <div class="breadcrumb-item">Create +</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-xl-12 col-md-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h4>Create New Category</h4>
                        </div>

                        <div class="card-body">

                            <form method="POST"
                                action="{{ route('admin.category.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="name" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" name="name" value="{{old('name')}}">
                                </div>

                                <div class="form-group">
                                    <label for="icon" class="form-label">Category Icon</label>
                                    <button name="icon"
                                    class="btn btn-primary btn-block" data-placement="bottom" data-unselected-class="btn-info" role="iconpicker"></button>
                                </div>

                                <div class="form-group">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-block btn-outline-primary">
                                        Add New Category
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
