@section('title')
    {{$settings->site_name}} || {{auth()->user()->name}}
@endsection

@extends('admin.layouts.main')

@section('content')

<section class="section">
    <div class="section-header">
      <h1>{{__('Profile')}}</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">{{__('Dashboard')}}</a></div>
        <div class="breadcrumb-item">{{__('Profile')}}</div>
      </div>
    </div>
    <div class="section-body">

      <div class="row mt-sm-4">

        <div class="col-12 col-md-12 col-lg-7">
          <div class="card">

            <form method="POST" action="{{route('admin.profile.update', auth()->id())}}"
            class="needs-validation" novalidate="" enctype="multipart/form-data">
                @csrf
                @method('PUT')

              <div class="card-header">
                <h4>{{__('Edit Profile')}}</h4>
              </div>

              <div class="card-body">
                  <div class="row">

                    <div class="form-group col-12">

                        <div class="mb-3">
                            <img src="{{asset(Auth::user()->image)}}" width="200px" class="border border-5 rounded">
                        </div>

                        <label>{{__('Image')}}</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        @error('image')
                          <div class="text-danger">
                              {{$message}}
                          </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6 col-12">
                      <label>{{__('Name')}}</label>
                      <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" required="">
                      @error('name')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                      @enderror
                    </div>

                    <div class="form-group col-md-6 col-12">
                      <label>{{__('Email')}}</label>
                      <input type="text" name="email" class="form-control" value="{{ Auth::user()->email }}" required="">
                      @error('email')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                      @enderror
                    </div>
                  </div>

              </div>


              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">{{__('Save Changes')}}</button>
              </div>
            </form>

          </div>
        </div>

        <div class="col-12 col-md-12 col-lg-7">
            <div class="card">

              <form method="post" action="{{route('admin.password.update')}}"
              class="needs-validation" novalidate="">
                  @csrf

                <div class="card-header">
                  <h4>{{__('Edit Password')}}</h4>
                </div>

                <div class="card-body">
                    <div class="row">

                      <div class="form-group col-12">
                        <label>{{__('Current Password')}}</label>
                        <input type="password" name="current_password" class="form-control">
                        @error('current_password')
                          <div class="text-danger">
                              {{$message}}
                          </div>
                        @enderror
                      </div>

                      <div class="form-group col-md-6 col-12">
                        <label>{{__('New Password')}}</label>
                        <input type="password" name="password" class="form-control">
                        @error('password')
                          <div class="text-danger">
                              {{$message}}
                          </div>
                        @enderror
                      </div>

                      <div class="form-group col-md-6 col-12">
                        <label>{{__('Confirm Password')}}</label>
                        <input type="password" name="password_confirmation" class="form-control">
                      </div>

                    </div>

                    <div class="card-footer text-right">
                        <button class="btn btn-primary">{{__('Save Changes')}}</button>
                    </div>

                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  </section>

@endsection
