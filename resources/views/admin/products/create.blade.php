@extends('admin.layouts.main')

@section('content')

    <section class="section">
        <div class="section-header">
            <h1>{{__('Add New', ['name' => __('Product')])}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                    {{__('Dashboard')}}
                </a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">
                    {{__('Manage Products')}}
                </a></div>
                <div class="breadcrumb-item">{{__('Create')}} +</div>
            </div>
        </div>

        <div class="section-body">

            <div class="mb-4">
                <x-back-arrow :href='route("admin.products.index")'/>
            </div>

            <div class="row">
                <div class="col-12 col-xl-12 col-md-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h4>{{__('Create New Product')}}</h4>
                        </div>

                        <div class="card-body">

                            <form method="POST" action="{{ route('admin.products.store') }}"
                            enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3 form-group">
                                    <label for="formFileMultiple" class="form-label">{{__('thumb_image')}}</label>
                                    <input class="form-control" name="thumb_image" type="file">
                                        @error('thumb_image')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('Name')}}</label>
                                    <input type="text" name="name" value="{{old('name')}}" class="form-control">
                                        @error('name')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('Availlable Stock')}}</label>
                                    <input type="number" min="1" name="quantity" value="{{old('quantity')}}" class="form-control">
                                        @error('quantity')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('Short Description')}}</label>
                                    <textarea name="short_description" class="form-control">
                                        {{old('short_description')}}
                                    </textarea>
                                        @error('short_description')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('Full Description')}}</label>
                                    <textarea name="long_description" class="summernote">
                                        {{old('long_description')}}
                                    </textarea>
                                        @error('long_description')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <div class="row">

                                    <div class="form-group col-md-4">
                                        <label class="form-label">{{__('Category')}}</label>
                                        <select name="category_id" class="form-control main-category">
                                            <option selected disabled>{{__('Choose First')}}</option>
                                            @foreach ($categories_view as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                            @error('category_id')
                                                <div class="text-danger">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label class="form-label">{{__('Sub-Category')}}</label>
                                        <select name="sub_category_id" class="form-control sub-category">
                                            <option selected disabled>{{__('Select')}}</option>

                                        </select>
                                            @error('sub_category_id')
                                                <div class="text-danger">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label class="form-label">{{__('Child-Category')}}</label>
                                        <select name="child_category_id" class="form-control child-category">
                                            <option selected disabled>{{__('Select')}}</option>

                                        </select>
                                            @error('child_category_id')
                                                <div class="text-danger">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('Brand')}}</label>
                                    <select name="brand_id" class="form-control">
                                        <option selected disabled>{{__('Select')}}</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                        @error('brand_id')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('SKU')}}</label>
                                    <input type="text" name="SKU" value="{{old('SKU')}}" class="form-control">
                                        @error('SKU')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('Video Link')}}</label>
                                    <input type="text" name="video_link" value="{{old('video_link')}}" class="form-control">
                                        @error('video_link')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('Price')}}</label>
                                    <input type="number" name="price" value="{{old('price')}}" class="form-control">
                                        @error('price')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('Offer Price')}}</label>
                                    <input type="number" name="offer_price" value="{{old('offer_price')}}" class="form-control">
                                        @error('offer_price')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">{{__('Offer Start Date')}}</label>
                                            <input type="date" name="offer_start_date" class="form-control">
                                                @error('offer_start_date')
                                                    <div class="text-danger">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">{{__('Offer End Date')}}</label>
                                            <input type="date" name="offer_end_date" class="form-control">
                                                @error('offer_end_date')
                                                    <div class="text-danger">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                        </div>
                                    </div>

                                </div>


                                <div class="form-group">
                                    <label class="form-label">{{__('Product Label')}}</label>
                                    <select name="product_type" class="form-control">
                                        <option disabled selected>{{__('Select')}}</option>
                                        <option value="new">{{__('New')}} 🆕</option>
                                        <option value="featured">{{__('featured')}} ⭐</option>
                                        <option value="top">{{__('top')}} 🔝</option>
                                    </select>
                                        @error('product_type')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>



                                <div class="form-group">
                                    <label class="form-label">{{__('SEO Title')}}</label>
                                    <input type="text" name="seo_title" class="form-control">
                                        @error('seo_title')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('SEO Description')}}</label>
                                    <textarea type="text" name="seo_description" class="form-control">
                                        {{old('seo_description')}}
                                    </textarea>
                                        @error('seo_description')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label>{{__("Status")}}</label>
                                    <select name="status" value="{{old('status')}}" class="form-control">
                                        <option selected disabled>{{__('Select')}}</option>
                                        <option value="active">{{__('Active')}} ✅</option>
                                        <option value="inactive">{{__('Inactive')}} 🚫</option>
                                    </select>
                                        @error('status')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-outline-primary btn-block btn-lg">
                                        {{__('Create Product')}}
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection

@push('scripts')

    <script>
        var myUrl = "{{route('admin.product.get-subcategories')}}";
        var childUrl = "{{route('admin.product.get-childcategories')}}";
    </script>

    {{-- Get Sub-Categories AJAX --}}
    <script src="{{ asset('backend/assets/js/sub-categories-view.js') }}"></script>

    {{-- Get Child-Categories AJAX --}}
    <script src="{{ asset('backend/assets/js/child-categories.js') }}"></script>

@endpush
