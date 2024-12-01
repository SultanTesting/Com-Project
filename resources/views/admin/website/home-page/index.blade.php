@extends('admin.layouts.main')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Settings') }}</h1>
            <div class="breadcrumb section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.slider.index') }}">{{ __('Manage Website') }}</a></div>
                <div class="breadcrumb-item">{{ __('Settings') }}</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">

                            <div class="row">
                                <div class="col-3">
                                    <div class="list-group" id="list-tab" role="tablist">
                                        <a class="list-group-item list-group-item-action active" id="list-general-list"
                                            data-toggle="list" href="#list-general" role="tab">
                                            {{__('Top Categories')}}
                                        </a>
                                        <a class="list-group-item list-group-item-action" id="list-profile-list"
                                            data-toggle="list" href="#list-profile" role="tab">
                                            {{__('Profile')}}
                                        </a>
                                        <a class="list-group-item list-group-item-action" id="list-messages-list"
                                            data-toggle="list" href="#list-messages" role="tab">
                                            {{__('Messages')}}
                                        </a>
                                        <a class="list-group-item list-group-item-action" id="list-settings-list"
                                            data-toggle="list" href="#list-settings" role="tab">
                                            {{__('Settings')}}
                                        </a>
                                    </div>
                                </div>

                                <div class="col-9">

                                    <div class="tab-content" id="nav-tabContent">

                                        @include('admin.website.home-page.sections.top-categories')

                                        <div class="tab-pane fade" id="list-profile" role="tabpanel"
                                            aria-labelledby="list-profile-list">
                                            Ahmed Mohamed
                                        </div>
                                        <div class="tab-pane fade" id="list-messages" role="tabpanel"
                                            aria-labelledby="list-messages-list">
                                            Walaa Samy
                                        </div>
                                        <div class="tab-pane fade" id="list-settings" role="tabpanel"
                                            aria-labelledby="list-settings-list">
                                            Sultaaaaaaaaaaaan
                                        </div>

                                    </div>
                                </div>
                            </div>
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

    <script>
        let list = @json(config('settings.currency_list'));
    </script>

    <script>
        $(document).ready(function(){
            $('body').on('change', '.currency_name', function()
            {
                let currency_name = $(this).val();

                $('.currency_syb').attr('value', list[currency_name]['symbol']);

            })
        })
    </script>
@endpush

