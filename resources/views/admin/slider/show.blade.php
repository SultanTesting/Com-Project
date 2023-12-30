@extends('admin.layouts.main')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{__('Slider')}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('Dashboard')}}</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.slider.index') }}">{{__('Manage Website')}}</a></div>
                <div class="breadcrumb-item">{{__('Showing')}}</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-6 col-lg-12">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h4>{{ $slider->type }}</h4>
                        </div>
                        <div class="card-body">

                            <div class="card text-center">

                                <div class="card-body">
                                  <h5 class="card-title">{{$slider->title}}</h5>

                                  <img src="{{
                                    ($slider->banner)
                                    ? asset($slider->banner)
                                    : asset('frontend/images/no-image.jpg')
                                    }}"
                                    width="200px" class="img-thumbnail">

                                  <p class="card-text mt-2 font-weight-bold">{{$slider->starting_price}} $</p>

                                  <div>
                                    @if ($slider->status == 'Active')
                                        <p class="text-success font-weight-bold">{{__('Available')}}</p>
                                    @else
                                        <p class="text-danger">{{__('Out Of Stock')}}</p>
                                    @endif
                                  </div>

                                  <a href="{{route('admin.slider.index')}}"
                                    class="font-weight-bold" style="text-decoration: none; font-size: 30px">
                                        🔙
                                  </a>
                                </div>
                                <div class="card-footer text-muted">
                                  {{$slider->uploadDate()}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
