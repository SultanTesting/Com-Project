@extends('admin.layouts.main')

@section('content')

    <section class="section">

        <div class="section-header">

            <h1>{{__('Product Variants')}} [ <code>{{$product->name}}</code> ] </h1>

            <div class="breadcrumb section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">
                    {{__('Dashboard')}}
                </a></div>
                <div class="breadcrumb-item"><a href="{{route('admin.products.index')}}">
                    {{__('Manage Products')}}
                </a></div>
                <div class="breadcrumb-item">{{__('Product Variants')}}</div>
            </div>

        </div>

        <div class="section-body">

            <div class="mb-4">
                <a class="back-arrow" href="{{route('admin.products.index')}}">
                    <i style="font-size: 40px" class="fas {{(dirSelect() == 'rtl') ? 'fa-arrow-alt-circle-right' : 'fa-arrow-alt-circle-left'}}"></i>
                </a>
            </div>

            <div class="row">
                <div class="col-12 col-md-6 col-lg-12">
                    <div class="card">

                        <div class="card-header justify-content-between">
                            <h4>{{__('Variants Table')}}</h4>

                            <a href="{{route('admin.product-variants.create', ['product' => $product->id])}}" class="btn btn-primary">
                                <i class="fa fa-plus" aria-hidden="true"></i> {{__('Create')}}
                            </a>
                        </div>

                        <div class="card-body">
                            <table>
                                {{$dataTable->table()}}
                            </table>
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
        var myUrl = @json(route('admin.product.variants.status'));
        var myToken = @json(csrf_token());
    </script>

    <script src="{{ asset('backend/assets/js/change-status.js') }}"></script>

@endpush


