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
                        <h4>Verify Email Address</h4>
                        <ul>
                            <li><a href="{{route('home')}}">SAZAO</a></li>
                            <li><a href="{{route('verification.notice')}}">Verify Email</a></li>
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
        CHANGE PASSWORD START
    ==============================-->
    <section id="wsus__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-md-10 col-lg-7 m-auto">

                    <div class="mb-4 text-muted text-center">
                        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                    </div>

                    <div class="d-flex justify-content-between align-items-center">

                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                                <button class="common_btn" type="submit">Resend Verification Link</button>
                        </form>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                                <button type="submit" class="btn btn-danger btn-sm rounded-pill">Logout</button>

                        </form>


                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--============================
        CHANGE PASSWORD END
    ==============================-->
@endsection
