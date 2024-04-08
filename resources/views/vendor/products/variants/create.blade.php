@extends('vendor.layouts.main')

@section('content')

<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
        <div class="dashboard_content mt-2 mt-md-0">

            <h3><i class="far fa-store"></i>
                {{__('Create New', ['name' => __('Variants')])}} -> <code> [ {{$product->name}} ] </code>
            </h3>

            <hr>

            <div class="wsus__dashboard_profile">
                <div class="wsus__dash_pro_area">

                    <form method="POST"
                        action="{{ route('vendor.variants.store', ['product' => request()->product]) }}">
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

                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-outline-primary">
                                {{__('Add New', ['name' => __('Variants')])}}
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>


@endsection
