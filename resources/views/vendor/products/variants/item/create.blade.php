@extends('vendor.layouts.main')

@section('content')

<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
        <div class="dashboard_content mt-2 mt-md-0">

            <h3><i class="far fa-store"></i>
                {{__('Create New', ['name' => __('Item')])}}   <code> [ {{$variant->name}} ] </code>
            </h3>

            <hr>

            <div class="wsus__dashboard_profile">
                <div class="wsus__dash_pro_area">

                    <form method="POST"
                        action="{{ route('vendor.item.store',
                        ['product' => request()->product, 'variant' => request()->variant]) }}">
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


                        <div class="form-group mt-3">
                            <label for="status" class="form-label">{{__('Status')}}</label>
                            <select name="status" class="form-control">
                                <option selected disabled>{{__('Select')}}</option>
                                <option value="active">{{__('Active')}}</option>
                                <option value="inactive">{{__('Inactive')}}</option>
                            </select>
                        </div>

                        <input type="hidden" name="product_variants_id" value="{{request()->variant}}">
                        <input type="hidden" name="product" value="{{request()->product}}">

                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-outline-primary">
                                {{__('Add New', ['name' => __('Item')])}}
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>


@endsection

