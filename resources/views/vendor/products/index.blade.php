@extends('vendor.layouts.main')

@section('content')

<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
        <div class="dashboard_content mt-2 mt-md-0">

            <h3><i class="far fa-store"></i>{{__('Products')}}</h3>

            <hr>

            <div class="d-md-flex justify-content-md-end mb-3">
                <a href="{{route('vendor.products.create')}}" class="btn btn-secondary btn-block">{{__('Create')}} +</a>
            </div>

            <div class="wsus__dashboard_profile">
                <div class="wsus__dash_pro_area">

                    {{$dataTable->table()}}

                </div>
            </div>

        </div>
    </div>
</div>


@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        var myUrl = @json(route('vendor.product.status'));
        var myToken = @json(csrf_token());
    </script>

    <script src="{{ asset('backend/assets/js/change-status.js') }}"></script>
@endpush
