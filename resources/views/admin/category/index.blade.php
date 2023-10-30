@extends('admin.layouts.main')

@section('content')

    <section class="section">
        <div class="section-header">
        <h1>Categories</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{route('admin.category.index')}}">Manage Categories</a></div>
            <div class="breadcrumb-item">Category</div>
        </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-6 col-lg-12">
                    <div class="card">

                        <div class="card-header justify-content-between">
                            <h4>Categories Table</h4>
                            <a href="{{route('admin.category.create')}}" class="btn btn-primary">
                                <i class="fa fa-plus" aria-hidden="true"></i> Create
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

    <script> // change category status
        $(document).ready(function(){

            var debounce = null;
            $('body').on('click', '.change-status', function(){
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                clearTimeout(debounce);

                debounce = setTimeout(function(){
                    $.ajax(
                    {
                        url: "{{route('admin.category.change-status')}}",
                        method: 'PUT',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            status: isChecked,
                            id: id
                        },
                        success: function(data){
                            toastr.success(data.message);
                            setTimeout(() => {
                                window.location.reload();
                            }, 3000);
                        },
                        error: function(xhr, status, error){
                            console.log(error);
                        }

                    })
                }, 1000)

            })
        })
    </script>
@endpush
