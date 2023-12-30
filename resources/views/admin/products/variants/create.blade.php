@extends('admin.layouts.main')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{__('Add New', ['name' => __('Variants')])}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                    {{__('Dashboard')}}
                </a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">
                    {{__('Manage Products')}}
                </a></div>
                <div class="breadcrumb-item">{{__('Create')}} +</div>
            </div>
        </div>

        <div class="section-body">

            <div class="mb-4">
                <x-back-arrow :href='route("admin.products.index"),
                ["product" => $product->id]'/>
            </div>

            <div class="row">
                <div class="col-12 col-xl-12 col-md-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h4>{{__('Create New', ['name' => __('Variants')])}}</h4>
                        </div>

                        <div class="card-body">

                            <form method="POST"
                                action="{{ route('admin.product-variants.store') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="name" class="form-label">{{__('Variant Name')}}</label>
                                    <input type="text" class="form-control" name="name" value="{{old('name')}}">
                                </div>


                                <div class="form-group">
                                    <label for="status" class="form-label">{{__('Status')}}</label>
                                    <select name="status" class="form-control">
                                        <option selected disabled>{{__('Select')}}</option>
                                        <option value="Active">{{__('Active')}}</option>
                                        <option value="Inactive">{{__('Inactive')}}</option>
                                    </select>
                                </div>

                                <input type="hidden" name="product_id" value="{{$product->id}}">

                                <div>
                                    <button type="submit" class="btn btn-block btn-outline-primary">
                                        {{__('Add New', ['name' => __('Variants')])}}
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
