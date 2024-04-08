@extends('admin.layouts.main')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{__('Add New Category')}}</h1>
            <div class="breadcrumb section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                    {{__('Dashboard')}}
                </a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">
                    {{__('Manage Categories')}}
                </a></div>
                <div class="breadcrumb-item">{{__('Create')}} +</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-xl-12 col-md-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h4>{{__('Create New Category')}}</h4>
                        </div>

                        <div class="card-body">

                            <form method="POST"
                                action="{{ route('admin.category.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="name" class="form-label">{{__('Category Name')}}</label>
                                    <input type="text" class="form-control" name="name" value="{{old('name')}}">
                                    <x-input-error :messages="$errors->get('name')" class="alert-danger mb-2"/>
                                </div>

                                <div class="form-group">
                                    <label for="icon" class="form-label">{{__('Category Icon')}}</label>
                                    <button name="icon"
                                    class="btn btn-primary btn-block" data-placement="bottom" data-unselected-class="btn-info" role="iconpicker"></button>
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
                                        {{__('Add New Category')}}
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
