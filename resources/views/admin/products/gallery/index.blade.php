@extends('admin.layouts.main')

@section('content')

    <section class="section">

        <div class="section-header">

            <h1>{{__('Product Image Gallery')}} [ <code>{{$product->name}}</code> ]</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">
                    {{__('Dashboard')}}
                </a></div>
                <div class="breadcrumb-item"><a href="{{route('admin.products.index')}}">
                    {{__('Manage Products')}}
                </a></div>
                <div class="breadcrumb-item">{{__('Image Gallery')}}</div>
            </div>

        </div>

        <div class="section-body">

            <div class="mb-4">
                <x-back-arrow :href='route("admin.products.index")'/>
            </div>

            <div class="row">
                <div class="col-12 col-md-6 col-lg-12">
                    <div class="card">

                        <div class="card-header">
                            <h4>{{__('Upload Files')}}</h4>
                        </div>

                        <div class="card-body">

                            <form id="form" method="POST" action="{{route('admin.product-gallery.store')}}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label class="form-label">{{__('Upload', ['name' => __('Image')])}}
                                        <code> [ {{__('Multiple Image Supported')}} ] 📁</code>
                                    </label>
                                    <input type="file" name="images[]" multiple accept="image/*" class="form-control images">
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <input type="hidden" name="name" value="{{$product->slug}}">
                                </div>

                                <button type="submit" class="btn btn-outline-success btn-block button">
                                    <i class="fas fa-upload"></i>
                                </button>

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
                                                <form action="{{route('admin.product-gallery.destroy', $image->id)}}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{route('admin.product-gallery.destroy', ['gallery' => $image->id, 'name' => $product->slug])}}"
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

    </section>

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
