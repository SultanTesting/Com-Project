@extends('admin.layouts.main')

@section('content')


<section class="section">
    <div class="section-header">
    <h1>Products</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{route('admin.slider.index')}}">Manage Website</a></div>
        <div class="breadcrumb-item">Products</div>
    </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h4>Poducts Table</h4>
                        <a href="{{route('admin.slider.create')}}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Create</a>
                    </div>
                    <div class="card-body">
                        <table>
                            {{ $dataTable->table() }}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="d-flex justify-content-center">
        {{$data->links()}}
    </div> --}}

</section>

@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

