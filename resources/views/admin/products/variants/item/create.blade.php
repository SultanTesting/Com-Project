@extends('admin.layouts.main')

@section('content')

    <section class="section">
        <div class="section-header">
            <h1>{{__('Add New', ['name' => __('Item')])}}</h1>

            <div class="breadcrumb section-header-breadcrumb">
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
                <x-back-arrow :href='route("admin.product.variant-item.index",
                    ["productId" => $variant->product_id, "variantId" => $variant])'/>
            </div>

            <div class="row">
                <div class="col-12 col-xl-12 col-md-6">
                    <div class="card">

                        <div class="card-header justify-content-between">
                            <h4>{{__('Create New', ['name' => __('Item')])}}  [ <code>{{$variant->name}}</code> ]</h4>
                        </div>

                        <div class="card-body">

                            <form method="POST"
                                action="{{ route('admin.product.variant-item.store') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="name" class="form-label">{{__('Item Name')}}</label>
                                    <input type="text" class="form-control" name="name" value="{{old('name')}}">
                                </div>


                                <div class="form-group">
                                    <label for="name" class="form-label">
                                        {{__('Price')}} <code>[ {{__('Set 0 To Make It FREE')}} ]</code>
                                    </label>
                                    <input type="number" class="form-control" name="price" value="{{old('price')}}">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('Default')}}</label>
                                    <select name="default" class="form-control">
                                        <option selected disabled>{{__('Select')}}</option>
                                        <option value="yes">{{__('Yes')}}</option>
                                        <option value="no">{{__('No')}}</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="status" class="form-label">{{__('Status')}}</label>
                                    <select name="status" class="form-control">
                                        <option selected disabled>{{__('Select')}}</option>
                                        <option value="Active">{{__('Active')}}</option>
                                        <option value="Inactive">{{__('Inactive')}}</option>
                                    </select>
                                </div>

                                <input type="hidden" name="product_variants_id" value="{{request()->variant}}">
                                <input type="hidden" name="product" value="{{request()->product}}">

                                <div>
                                    <button type="submit" class="btn btn-block btn-outline-primary">
                                        {{__('Add New', ['name' => __('Variant')])}}
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
