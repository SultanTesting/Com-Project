@section('title', "$settings->site_name || Forgot Password")


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
                        <h4>forget password</h4>
                        <ul>
                            <li><a href="{{route('login')}}">login</a></li>
                            <li><a href="{{route('password.request')}}">forget password</a></li>
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
        FORGET PASSWORD START
    ==============================-->
    <section id="wsus__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 m-auto">
                    <div class="wsus__forget_area">
                        <span class="qiestion_icon"><i class="fal fa-question-circle"></i></span>
                        <h4>forget password ?</h4>
                        <p class="fs-6 text-muted">
                            No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                        </p>

                        @if ($message = session('status'))
                            <div class="text-success text-center mt-3 fw-bold">
                                {{$message}}
                            </div>
                        @endif

                        <div class="wsus__login">
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="wsus__login_input">
                                    <i class="fal fa-envelope"></i>
                                    <input type="email" id="email" name="email" value="{{old('email')}}" placeholder="Your Email" autofocus>
                                </div>

                                @error('email')
                                    <p class="text-danger">
                                        {{$message}}
                                    </p>
                                @enderror

                                <button class="common_btn" type="submit">send</button>
                            </form>
                        </div>
                        <a class="see_btn mt-4" href="{{route('login')}}">go to login</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        FORGET PASSWORD END
    ==============================-->

@endsection
