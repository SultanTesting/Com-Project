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
                        <h4>{{__('Login')}} / {{__('Register')}}</h4>
                        <ul>
                            <li><a href="{{route('home')}}">{{__('home')}}</a></li>
                            <li><a href="{{route('login')}}">{{__('Login')}} / {{__('Register')}}</a></li>
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
       LOGIN/REGISTER PAGE START
    ==============================-->
    <section id="wsus__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 m-auto">
                    <div class="wsus__login_reg_area">

                        <ul class="nav nav-pills mb-3" id="pills-tab2" role="tablist">

                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab2" data-bs-toggle="pill"
                                    data-bs-target="#pills-homes" type="button" role="tab" aria-controls="pills-homes"
                                    aria-selected="true">{{__('Login')}}</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab2" data-bs-toggle="pill"
                                    data-bs-target="#pills-profiles" type="button" role="tab"
                                    aria-controls="pills-profiles" aria-selected="true">{{__('Register')}}</button>
                            </li>

                        </ul>

                        <div class="tab-content" id="pills-tabContent2">

                            {{-- !Login Form  --}}
                            <div class="tab-pane fade show active" id="pills-homes" role="tabpanel"
                                aria-labelledby="pills-home-tab2">
                                <div class="wsus__login">

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="wsus__login_input">
                                            <i class="fas fa-user-tie"></i>
                                            <input type="email" id="email" name="email" value="{{old('email')}}" placeholder="{{__('Email')}}" autofocus
                                            class="@error('email') border-danger @enderror">
                                        </div>


                                        <div class="wsus__login_input">
                                            <i class="fas fa-key"></i>
                                            <input id="password" name="password" type="password"
                                            placeholder="{{__('Password')}}"
                                            class="@error('password') border-danger @enderror">

                                        </div>


                                        <div class="wsus__login_save">
                                            <div class="form-check form-switch">
                                                <input id="remember_me" name="remember"
                                                class="form-check-input" type="checkbox"
                                                id="flexSwitchCheckDefault">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">
                                                    {{__('Remember me')}}
                                                </label>
                                            </div>
                                            <a class="forget_p" href="{{route('password.request')}}">
                                                {{__('Forgot your password?')}}
                                            </a>
                                        </div>

                                        <button class="common_btn" type="submit">{{__('Login')}}</button>

                                        <p class="social_text">{{__('Sign in with social account')}}</p>
                                        <ul class="wsus__login_link">
                                            <li><a href="#"><i class="fab fa-google"></i></a></li>
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                        </ul>
                                    </form>
                                </div>
                            </div>
                            {{-- ! END OF Login Form  --}}

                            {{-- !Register Form  --}}
                            <div class="tab-pane fade" id="pills-profiles" role="tabpanel"
                                aria-labelledby="pills-profile-tab2">
                                <div class="wsus__login">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf

                                        <div class="wsus__login_input">
                                            <i class="fas fa-user-tie"></i>
                                            <input type="text" id="name" name="name" value="{{old('name')}}" placeholder="{{__('Name')}}" autofocus>
                                        </div>


                                        <div class="wsus__login_input">
                                            <i class="far fa-envelope"></i>
                                            <input type="email" id="email" name="email" value="{{old('email')}}" placeholder="{{__('Email')}}">
                                        </div>

                                        <div class="wsus__login_input">
                                            <i class="fas fa-key"></i>
                                            <input type="password" id="password" name="password"
                                            placeholder="{{__('Password')}}">
                                        </div>

                                        <div class="wsus__login_input">
                                            <i class="fas fa-key"></i>
                                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="{{__('Confirm Password')}}">
                                        </div>

                                        <button class="common_btn mt-4" type="submit">{{__('Register')}}</button>
                                    </form>
                                </div>
                            </div>
                            {{-- !END Of Register Form  --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
       LOGIN/REGISTER PAGE END
    ==============================-->

@endsection
