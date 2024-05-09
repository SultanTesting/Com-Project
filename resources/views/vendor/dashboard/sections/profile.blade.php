@section('title', "$settings->site_name || Vendor Profile")

@extends('vendor.layouts.main')

@section('content')

<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
      <div class="dashboard_content mt-2 mt-md-0">
        <h3><i class="far fa-user"></i> {{__('Profile')}}</h3>
        <div class="wsus__dashboard_profile">


            <div class="row">

                {{-- INFO Form --}}

                <div class="wsus__dash_pro_area">
                    <h4>{{__('Basic Information')}}</h4>

                    <form method="POST" action="{{route('vendor.profile.update')}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="col-md-12">

                            <div class="col-md-2">
                                <div class="wsus__dash_pro_img">
                                    <?php $image = Auth::user()->image ?>
                                    <img src="{{$image ? asset($image) : asset('frontend/images/no-image.jpg')}}"
                                    alt="img" class="img-fluid w-100">
                                    <input type="file" name="image" accept="image/*">
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-md-12">
                                <div class="wsus__dash_pro_single">
                                    <i class="fas fa-user-tie"></i>
                                    <input type="text" name="name" value="{{Auth::user()->name}}" placeholder="{{__('Name')}}">
                                </div>
                                </div>


                                <div class="col-md-12">
                                <div class="wsus__dash_pro_single">
                                    <i class="fal fa-envelope-open"></i>
                                    <input type="email" name="email" value="{{Auth::user()->email}}" placeholder="{{__('Email')}}">
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                        <button class="common_btn mb-4 mt-2" type="submit">{{__('Update', ['name' => __('Basic Information')])}}</button>
                        </div>

                    </form>
                </div>

                {{-- Password Form --}}

                <div class="wsus__dash_pro_area mt-4">
                    <h4>{{__('Change Password')}}</h4>

                    <form method="POST" action="{{route('vendor.profile.password')}}">
                        @csrf

                        <div class="wsus__dash_pass_change mt-2">
                        <div class="row">

                            <div class="col-xl-4 col-md-6">
                            <div class="wsus__dash_pro_single">
                                <i class="fas fa-unlock-alt"></i>
                                <input type="password" name="current_password" placeholder="{{__('Current Password')}}">
                            </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                            <div class="wsus__dash_pro_single">
                                <i class="fas fa-lock-alt"></i>
                                <input type="password" name="password" placeholder="{{__('New Password')}}">
                            </div>
                            </div>

                            <div class="col-xl-4">
                            <div class="wsus__dash_pro_single">
                                <i class="fas fa-lock-alt"></i>
                                <input type="password" name="password_confirmation" placeholder="{{__('Confirm Password')}}">
                            </div>
                            </div>

                            <div class="col-xl-12">
                            <button class="common_btn" type="submit">
                                {{__('Update', ['name' => __('Password')])}}
                            </button>
                            </div>
                        </div>

                        </div>

                    </form>

                </div>


            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
