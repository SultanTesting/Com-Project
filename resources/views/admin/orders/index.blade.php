@extends('admin.layouts.main')

@section('content')

    <section class="section">
        <div class="section-header">
        <h1>{{__('Orders')}}</h1>
        <div class="breadcrumb section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">
                {{__('Dashboard')}}
            </a></div>
            <div class="breadcrumb-item"><a href="{{route('admin.order.index')}}">
                {{__('Manage Orders')}}
            </a></div>
            <div class="breadcrumb-item">{{__('Orders')}}</div>
        </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-6 col-lg-12">
                    <div class="card">

                        <div class="card-header justify-content-between">
                            <h4>{{__('Orders Table')}}</h4>
                            <div class="dropdown {{(dirSelect() == 'rtl') ? 'dropend' : 'dropstart'}}">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                  {{__('Filter Orders')}}
                                </button>
                                <ul class="dropdown-menu border" style="width: 1px" aria-labelledby="dropdownMenuButton1">
                                  <li>
                                    <a class="dropdown-item"
                                    href="{{route('admin.order.index')}}">
                                    <i class="fas fa-list fa-lg"></i>  &nbsp; {{__('All Orders')}}</a></li>
                                  <li>
                                    <a class="dropdown-item"
                                    href="{{route('admin.order.index', ['filter' => 'pending'])}}">
                                    <i class="fas fa-hourglass"></i> &nbsp; {{__('Pending')}}</a></li>
                                  <li>
                                    <a class="dropdown-item"
                                    href="{{route('admin.order.index', ['filter' => 'dropped_off'])}}">
                                    <i class="fas fa-dolly"></i>&nbsp; {{__('Picked')}}</a></li>
                                  <li>
                                    <a class="dropdown-item"
                                    href="{{route('admin.order.index', ['filter' => 'out_for_delivery'])}}">
                                    <i class="fas fa-shipping-fast"></i>&nbsp; {{__('Delivery')}}</a></li>
                                  <li>
                                    <a class="dropdown-item"
                                    href="{{route('admin.order.index', ['filter' => 'canceled'])}}">
                                    <i class="fas fa-ban"></i> &nbsp; {{__('Cancel')}}</a></li>
                                  <li>
                                    <a class="dropdown-item"
                                    href="{{route('admin.order.index', ['filter' => 'delivered'])}}">
                                    <i class="fas fa-check"></i> &nbsp; {{__('Completed')}}</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="card-body">

                                {{$dataTable->table()}}

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        var myUrl = @json(route('admin.products.change-status'));
        var myToken = @json(csrf_token());
    </script>

    <script src="{{ asset('backend/assets/js/change-status.js') }}"></script>

@endpush
