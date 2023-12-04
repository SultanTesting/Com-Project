@extends('admin.layouts.main')

@section('content')

    <section class="section">
        <div class="section-header">
            <h1>{{__('strings.Add New Brand')}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                    {{__('strings.Dashboard')}}
                </a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.brand.index') }}">
                    {{__('strings.Manage Products')}}
                </a></div>
                <div class="breadcrumb-item">{{__('strings.Create')}} +</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-xl-12 col-md-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h4>{{__('strings.Create New Brand')}}</h4>
                        </div>

                        <div class="card-body">

                            <form method="POST"
                                action="{{ route('admin.brand.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="name" class="form-label">{{__('strings.Brand Name')}}</label>
                                    <input type="text" class="form-control" name="name" value="{{old('name')}}">
                                </div>

                                <div class="form-group">
                                    <label for="logo" class="form-label">{{__('strings.Logo')}}</label>
                                    <input type="file" name="logo" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="featured" class="form-label">{{__('strings.Is Featured')}}</label>
                                    <select name="featured" class="form-control">
                                        <option selected disabled>{{__('strings.Select')}}</option>
                                        <option value="Yes">{{__('strings.Yes')}}</option>
                                        <option value="No">{{__('strings.No')}}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="status" class="form-label">{{__('strings.Status')}}</label>
                                    <select name="status" class="form-control">
                                        <option selected disabled>{{__('strings.Select')}}</option>
                                        <option value="Active">{{__('strings.Active')}}</option>
                                        <option value="Inactive">{{__('strings.Inactive')}}</option>
                                    </select>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-block btn-outline-primary">
                                        {{__('strings.Add New Brand')}}
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
