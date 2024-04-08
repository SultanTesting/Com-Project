@extends('admin.layouts.main')

@section('content')

    <section class="section">
        <div class="section-header">
            <div>
                <h1>{{__('Categories')}}</h1>
            </div>
            <div class="breadcrumb section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">
                    {{__('Dashboard')}}
                </a></div>
                <div class="breadcrumb-item"><a href="{{route('admin.category.index')}}">
                    {{__('Manage Categories')}}
                </a></div>
                <div class="breadcrumb-item">{{__('Category')}}</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-6 col-lg-12">
                    <div class="card">

                        <div class="card-header justify-content-between">
                            <h4>{{__('Categories Table')}}</h4>
                            <a href="{{route('admin.category.create')}}" class="btn btn-primary">
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
        var myUrl = @json(route('admin.category.change-status'));
        var myToken = @json(csrf_token());
    </script>

    <script src="{{ asset('backend/assets/js/change-status.js') }}"></script>
@endpush
