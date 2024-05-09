@section('title', "$settings->site_name || $product->name Gallery")

@extends('vendor.layouts.main')

@section('content')

<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
        <div class="dashboard_content mt-2 mt-md-0">

            <h2><i class="far fa-store"></i>
                {{__('Gallery')}} <code>[ {{$product->name}} ]</code>
            </h2>

            <hr>

            <x-back-arrow :href='route("vendor.products.index")'/>

            <div class="wsus__dashboard_profile">
                <div class="wsus__dash_pro_area">

                    <div class="section-body">

                        <div class="row mb-3">
                            <div class="col-12 col-md-6 col-lg-12">
                                <div class="card">

                                    <div class="card-header mb-3">
                                        <h4>{{__('Upload Files')}}</h4>
                                    </div>

                                    <div class="card-body">

                                        <form id="form" method="POST" action="{{route('vendor.product-gallery.store')}}" enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-group">
                                                <label class="form-label mb-2">{{__('Upload', ['name' => __('Image')])}}
                                                    <code> [ {{__('Multiple Image Supported')}} ] 📁</code>
                                                </label>
                                                <input type="file" name="images[]" multiple accept="image/*" class="form-control images">
                                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                                <input type="hidden" name="name" value="{{$product->slug}}">
                                            </div>

                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-outline-success button">
                                                    <i class="fas fa-upload"></i>
                                                </button>
                                            </div>

                                        </form>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="container-fluid">
                            <div class="row" data-masonry='{"percentPosition": true }'>

                                @if (count($images) == 0)
                                    <div class="col-12 col-md-6 col-lg-12">
                                        @include('components.empty-state')
                                    </div>
                                @else
                                    @foreach ($images as $image)
                                        <div class="col-sm-6 col-lg-4 mb-4">
                                            <div class="card">
                                                    <img src="{{ asset($image->images) }}" class="card-img-top">
                                                    <div class="photo-buttons">
                                                        <form action="{{route('vendor.product-gallery.destroy', $image->id)}}" method="POST">
                                                            @csrf
                                                            @method("delete")
                                                            <a href="{{route('vendor.product-gallery.destroy', ['gallery' => $image->id, 'name' => $product->slug])}}"
                                                                type="submit" class="btn btn-sm btn-danger delete-item">
                                                                <i class='far fa-trash-alt'></i>
                                                            </a>
                                                        </form>
                                                    </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>


@endsection

@push('scripts')
    <script>
        // Disable button while input is empty
        $('body').ready(function()
        {
            setInterval(() => {
                if(!$('.images').val())
                {
                    $('.button').prop('disabled', true);
                } else {
                    $('.button').prop('disabled', false);
                }
            }, 1000);
        })
    </script>

@endpush
