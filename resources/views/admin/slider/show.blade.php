@extends('admin.layouts.main')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Show Product</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.slider.index') }}">Manage Website</a></div>
                <div class="breadcrumb-item">Show</div>
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
                                        <p class="text-success font-weight-bold">Available</p>
                                    @else
                                        <p class="text-danger">Out Of Stock</p>
                                    @endif
                                  </div>

                                  <a href="{{route('admin.slider.index')}}" class="btn btn-secondary">Go Back</a>
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
