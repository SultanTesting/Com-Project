@section('title', "$settings->site_name || Vendor Orders")

@extends('vendor.layouts.main')

@section('content')

<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
        <div class="dashboard_content mt-2 mt-md-0">

            <h3><i class="fas fa-tasks"></i>{{__('Orders')}}</h3>

            <hr>

            <div class="d-md-flex justify-content-md-end mb-3">
                {{-- Filter Section --}}
                <div class="dropdown {{(dirSelect() == 'rtl') ? 'dropend' : 'dropstart'}}">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      {{__('Filter Orders')}}
                    </button>
                    <ul class="dropdown-menu border" style="width: 1px" aria-labelledby="dropdownMenuButton1">
                        <li>
                            <a class="dropdown-item"
                            href="{{route('vendor.orders.index')}}">
                            <i class="fas fa-list fa-lg"></i>  &nbsp; {{__('All Orders')}}</a>
                        </li>
                        <li>
                            <a class="dropdown-item"
                            href="{{route('vendor.orders.index', ['filter' => 'new'])}}">
                            <i class="fas fa-cart-plus"></i>  &nbsp; {{__('New')}}</a>
                        </li>
                        <li>
                            <a class="dropdown-item"
                            href="{{route('vendor.orders.index', ['filter' => 'shipped'])}}">
                            <i class="fas fa-shipping-fast"></i> &nbsp; {{__('Shipped')}}</a>
                        </li>
                        <li>
                            <a class="dropdown-item"
                            href="{{route('vendor.orders.index', ['filter' => 'canceled'])}}">
                            <i class="fas fa-ban"></i> &nbsp; {{__('Canceled')}}</a>
                        </li>
                    </ul>
                </div>
                {{-- End Of Filter Section --}}
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
@endpush
