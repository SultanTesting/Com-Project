@extends('admin.layouts.main')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Table</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.slider.index') }}">Manage Website</a></div>
                <div class="breadcrumb-item">Create +</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-xl-12 col-md-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h4>Create New Data</h4>
                        </div>

                        <div class="card-body">

                            <form method="POST" action="{{ route('admin.slider.store') }}" enctype="multipart/form-data">

                                <div class="mb-3 form-group">
                                    <label for="formFileMultiple" class="form-label">Upload Images</label>
                                    <input class="form-control" name="banner" type="file" id="formFileMultiple"
                                        multiple>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Type</label>
                                    <input type="text" name="type" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Starting Price $</label>
                                    <input type="text" name="starting_price" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Serial Number</label>
                                    <input type="text" name="serial" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Url</label>
                                    <input type="text" name="url" class="form-control">
                                </div>

                                <label>Status</label>
                                <select class="form-select" aria-label="Default select example" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>

                                <div class="d-grid gap-2 mt-4">
                                    <button type="submit" class="btn btn-outline-primary btn-lg fs-5 ">Create</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection
