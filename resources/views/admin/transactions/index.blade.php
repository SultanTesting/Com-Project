@extends('admin.layouts.main')

@section('content')

    <section class="section">
        <div class="section-header">
        <h1>{{__('Transactions')}}</h1>
        <div class="breadcrumb section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">
                {{__('Dashboard')}}
            </a></div>
            <div class="breadcrumb-item"><a href="{{route('admin.transactions')}}">
                {{__('Manage Transactions')}}
            </a></div>
            <div class="breadcrumb-item">{{__('Transactions')}}</div>
        </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-6 col-lg-12">
                    <div class="card">

                        <div class="card-header justify-content-between">
                            <div>
                                <form class="date-form" action="{{route('admin.transactions')}}">
                                    <input id="date-range" type="text" class="form-select date-range"
                                    style="width: 105%" >
                                    <input type="text" class="from" name="from" hidden>
                                    <input type="text" class="to" name="to" hidden>
                                </form>
                            </div>


                            {{-- <div class="dropdown {{(dirSelect() == 'rtl') ? 'dropend' : 'dropstart'}}">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{__('Filter Transactions')}}
                                </button>
                                <ul class="dropdown-menu border" style="width: 1px"     aria-labelledby="dropdownMenuButton1">
                                    <li>
                                    <a class="dropdown-item"
                                    href="{{route('admin.transactions')}}">
                                    <i class="fas fa-list fa-lg"></i>  &nbsp; {{__('All Transactions')}}</a>
                                    </li>
                                    <li>
                                    <a class="dropdown-item"
                                    href="{{route('admin.transactions', ['filter' => 'Paymob'])}}">
                                    <i class="fas fa-hourglass"></i> &nbsp; {{__('Paymob')}}</a>
                                    </li>
                                    <li>
                                    <a class="dropdown-item"
                                    href="{{route('admin.transactions', ['filter' => 'paypal'])}}">
                                    <i class="fab fa-cc-paypal"></i>&nbsp; {{__('Paypal')}}</a>
                                    </li>
                                    <li>
                                    <a class="dropdown-item"
                                    href="{{route('admin.transactions', ['filter' => 'stripe'])}}">
                                    <i class="fab fa-stripe"></i>&nbsp; {{__('Stripe')}}</a>
                                    </li>
                                    <li>
                                    <a class="dropdown-item"
                                    href="{{route('admin.transactions', ['filter' => 'cash'])}}">
                                    <i class="fas fa-money-bill-alt"></i> &nbsp; {{__('Cash')}}</a>
                                    </li>
                                </ul>
                            </div> --}}

                            <a href="{{route('admin.transactions')}}">
                                <i class="fas fa-list" style="font-size: 30px"></i>
                            </a>
                            <a href="{{route('admin.transactions', ['filter' => 'paypal'])}}" class="">
                                <i class="fab fa-cc-paypal" style="font-size: 30px"></i>
                            </a>
                            <a href="{{route('admin.transactions', ['filter' => 'stripe'])}}">
                                <i class="fab fa-stripe" style="font-size: 30px"></i>
                            </a>
                            <a href="{{route('admin.transactions', ['filter' => 'Paymob'])}}" class="btn btn-sm btn-outline-primary">Paymob</a>
                            <a href="{{route('admin.transactions', ['filter' => 'cash'])}}" >
                                <i class="fas fa-coins" style="font-size: 30px"></i>
                            </a>
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
        $('input[id="date-range"]').daterangepicker();
    </script>

    <script>
        $('#date-range').on('apply.daterangepicker', function(ev, picker) {
            let from = picker.startDate.format('YYYY-MM-DD');
            let to = picker.endDate.format('YYYY-MM-DD');
            $('.from').attr('value', from);
            $('.to').attr('value', to);

            $('.date-form').submit();
        });
    </script>

@endpush
