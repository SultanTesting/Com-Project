@extends('admin.layouts.main')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Settings') }}</h1>
            <div class="breadcrumb section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Manage Website') }}</a></div>
                <div class="breadcrumb-item">{{ __('Payment Settings') }}</div>
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
                                        <a class="list-group-item list-group-item-action active" id="list-paypal-list"
                                            data-toggle="list" href="#list-paypal" role="tab">
                                            {{__('Paypal')}}
                                        </a>
                                        <a class="list-group-item list-group-item-action" id="list-stripe-list"
                                            data-toggle="list" href="#list-stripe" role="tab">
                                            {{__('Stripe')}}</a>
                                        <a class="list-group-item list-group-item-action" id="list-paymob-list"
                                            data-toggle="list" href="#list-paymob" role="tab">
                                            {{__('Paymob')}}</a>
                                        <a class="list-group-item list-group-item-action" id="list-settings-list"
                                            data-toggle="list" href="#list-settings" role="tab">
                                            {{__('COD')}}</a>
                                    </div>
                                </div>

                                <div class="col-9">

                                    <div class="tab-content" id="nav-tabContent">

                                        @include('admin.payment-settings.sections.paypal')

                                        @include('admin.payment-settings.sections.stripe')

                                        @include('admin.payment-settings.sections.paymob')
                                        
                                        <div class="tab-pane fade" id="list-settings" role="tabpanel"
                                            aria-labelledby="list-settings-list">
                                            Lorem ipsum culpa in ad velit dolore anim labore incididunt do aliqua sit veniam
                                            commodo elit dolore do labore occaecat laborum sed quis proident fugiat sunt
                                            pariatur. Cupidatat ut fugiat anim ut dolore excepteur ut voluptate dolore
                                            excepteur mollit commodo.
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

@endsection



