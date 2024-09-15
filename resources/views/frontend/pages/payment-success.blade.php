@section('title', "$settings->site_name || Payment")

@extends('frontend.layouts.main')

@section('content')
    <!--============================
        BREADCRUMB START
    ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>payment</h4>
                        <ul>
                            <li><a href="{{route('home')}}">{{__('home')}}</a></li>
                            <li><a href="{{route('user.checkout')}}">{{__('checkout')}}</a></li>
                            <li><a href="javascript;">payment</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        PAYMENT PAGE START
    ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="wsus__pay_info_area">
                <div class="row justify-content-center">
                    <img style="width: auto" src="{{ asset('frontend/images/payment-done.png') }}" alt="payment-done">
                    <h1 class="text-center text-success">Payment Successfully</h1>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        PAYMENT PAGE END
    ==============================-->
@endsection

