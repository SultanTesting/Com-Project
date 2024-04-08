@extends('admin.layouts.main')

@section('content')

    <section class="section">
        <div class="section-header">
            <h1>{{__('Flash Sale')}}</h1>
            <div class="breadcrumb section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">
                    {{__('Dashboard')}}
                </a></div>
                <div class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">
                    {{__('Manage Website')}}
                </a></div>
                <div class="breadcrumb-item">{{__('Flash Sale')}}</div>
            </div>
        </div>

        <x-back-arrow :href="route('admin.flash-sale.index')"/>

        <div class="section-body">

            <div class="row">

                <div class="col-sm-7 card">

                    <div class="card-header">
                        <h4>{{__('Available Products')}}</h4>
                    </div>

                    <div class="card-body">
                        {{$dataTable->table()}}
                    </div>

                </div>

                <div class="col-sm-5">

                    <div class="card form-group">
                        <div class="card-header">
                            <h4>{{__('Flash End Date')}}</h4>
                        </div>
                        <div class="card-body">
                            <label class="form-label">{{__('Select Flash Sale End Date')}}</label>
                            <form action="{{route('admin.flash-sale.store')}}" method="POST">
                                @csrf
                                <input type="datetime-local" name="end_date" value="{{@$flash->end_date}}"
                                class="form-control" >
                                <button class="mt-2 btn btn-outline-primary">{{__('Submit')}}</button>
                            </form>
                        </div>
                    </div>

                    <div class="card form-group">
                        <div class="card-header">
                            <h4>{{__('Vendors Products')}}</h4>
                        </div>
                        <div class="card-body">
                            <label class="form-label">{{__("Add Whole Vendor's Product To Flash Sale")}}</label>
                            <form action="{{route('admin.flash-sale.store')}}" method="POST">
                                @csrf
                                <select name="vendor_id" class="form-control form-select vendor_select">
                                    <option selected disabled>{{__('Select')}}</option>
                                    @foreach ($vendors as $vendor)
                                        @if ($vendor->product->count() > 0)
                                            <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <button type="submit" class="mt-2 btn btn-outline-primary">{{__('Submit')}}</button>
                            </form>
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
        var flashStore = @json(route('admin.flash-sale.store'));

        var myToken = @json(csrf_token());
    </script>

    <script src="{{ asset('backend/assets/js/change-status.js') }}"></script>

    <script src="{{ asset('backend/assets/js/flash-sale.js') }}"></script>

@endpush
