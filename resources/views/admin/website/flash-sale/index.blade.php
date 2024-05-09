@section('title', "$settings->site_name || FlashSale")

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

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-6 col-lg-12">
                    <div class="card">

                        <div class="card-header justify-content-between">

                            @if (@$flash->end_date)
                                    <h4>{{__('Flash Sale Ends : ')}}
                                        <code>[ {{$flash->end_date->diffForHumans()}} ]</code>
                                    </h4>
                            @else
                                    <h4>{{__('No Flash Sales Now')}}</h4>
                            @endif

                            <div>
                                @if (@$flash->end_date)
                                    <a href="{{route('admin.flash-clear-all')}}" class="delete-item btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                        {{__('Clear All Products')}}
                                    </a>
                                @endif

                                <a href="{{route('admin.flash-sale.create')}}" class="btn btn-sm btn-primary" >
                                    <i class="fas fa-plus-circle"></i>
                                    {{__('Add Products')}}
                                </a>
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
        var myUrl = @json(route('admin.flash-status'));
        var myToken = @json(csrf_token());
    </script>

    <script src="{{ asset('backend/assets/js/change-status.js') }}"></script>

    {{-- Show at home button fn  --}}
    <script>
        $(document).ready(function(){

            var debounce = null ;
            $('body').on('change', '.show_toggle', function(event)
            {
                event.preventDefault();

                let home_id = $(this).data('id');
                let value = $(this).attr('id');

                clearTimeout(debounce); // Debounce to prevent randomly clicking

                debounce = setTimeout(function()
                {
                    $.ajax({
                    url: "{{route('admin.flash-sale.store')}}",
                    method: "POST",
                    data: {
                        "_token": myToken,
                        home_id: home_id,
                        value: value
                    },

                    success: function(data)
                    {
                        iziToast.success({title: "{{__('Success')}}", message: data.message});
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    },

                    error: function(xhr, status, error)
                    {
                        iziToast.error({title: "{{__('Oops')}}", message: error});
                        console.log(error);
                    }
                    })
                }, 1000);


            })
        })
    </script>


@endpush
