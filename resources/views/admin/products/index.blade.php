@extends('admin.layouts.main')

@section('content')

    <section class="section">
        <div class="section-header">
        <h1>{{__('Products')}}</h1>
        <div class="breadcrumb section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">
                {{__('Dashboard')}}
            </a></div>
            <div class="breadcrumb-item"><a href="{{route('admin.products.index')}}">
                {{__('Manage Products')}}
            </a></div>
            <div class="breadcrumb-item">{{__('Products')}}</div>
        </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-6 col-lg-12">
                    <div class="card">

                        <div class="card-header justify-content-between">
                            <h4>{{__('Products Table')}}</h4>
                            <a href="{{route('admin.products.create')}}" class="btn btn-primary">
                                <i class="fa fa-plus" aria-hidden="true"></i> {{__('Create')}}
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
        var myUrl = @json(route('admin.products.change-status'));
        var myToken = @json(csrf_token());
    </script>

    <script src="{{ asset('backend/assets/js/change-status.js') }}"></script>

@endpush
