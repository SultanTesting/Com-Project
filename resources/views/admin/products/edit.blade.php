@extends('admin.layouts.main')

@section('content')

    <section class="section">
        <div class="section-header">
            <h1>{{__('Edit', ['name' => __('Product')])}}</h1>
            <div class="breadcrumb section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                    {{__('Dashboard')}}
                </a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">
                    {{__('Manage Products')}}
                </a></div>
                <div class="breadcrumb-item">{{__('Edit', ['name' => __('Product')])}}</div>
            </div>
        </div>

        <div class="section-body">

            <div class="mb-4">
                <x-back-arrow :href='route("admin.products.index")'/>
            </div>

            <div dir="auto" class="row">
                <div class="col-12 col-xl-12 col-md-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h4>{{__('Edit', ['name' => __('Product')])}}</h4>
                        </div>

                        <div dir="auto" class="card-body">

                            <form method="POST" action="{{ route('admin.products.update', $product->id) }}"
                            enctype="multipart/form-data">
                                @csrf
                                @method("PUT")

                                @if ($product->thumb_image)
                                    <div class="form-group">
                                        <label class="form-label">{{__('Image Preview')}}</label>
                                        <div>
                                            <img src="{{asset($product->thumb_image)}}" class="img-thumbnail"
                                            width="450px">
                                        </div>
                                    </div>
                                @endif

                                <div class="mb-3 form-group">
                                    <label for="thumb_image" class="form-label">{{__('thumb_image')}}</label>
                                    <input class="form-control" name="thumb_image" id="thumb_image" type="file">
                                        @error('thumb_image')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('Name')}}</label>
                                    <input type="text" name="name" value="{{$product->name}}" class="form-control">
                                        @error('name')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('Availlable Stock')}}</label>
                                    <input type="number" min="1" name="quantity" value="{{$product->quantity}}" class="form-control">
                                        @error('quantity')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('Short Description')}}</label>
                                    <textarea name="short_description" class="form-control">
                                    {{$product->short_description}}
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
                                    {{$product->long_description}}
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
                                                <option {{($category->id == $product->category_id) ? 'selected' : ''}}
                                                    value="{{$category->id}}">{{$category->name}}
                                                </option>
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
                                            @foreach ($subCategories as $sub)
                                                <option {{($sub->id == $product->sub_category_id) ? 'selected' : ''}}
                                                    value="{{$sub->id}}">{{$sub->name}}</option>
                                            @endforeach
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
                                            @foreach ($childCategories as $child)
                                                <option {{($child->id == $product->child_category_id) ? 'selected' : ''}}
                                                    value="{{$child->id}}">{{$child->name}}</option>
                                            @endforeach
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
                                            <option {{($brand->id == $product->brand_id) ? 'selected' : ''}}
                                            value="{{$brand->id}}">{{$brand->name}}</option>
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
                                    <input type="text" name="SKU" value="{{$product->SKU}}" class="form-control">
                                        @error('SKU')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('Price')}}</label>
                                    <input type="number" name="price" value="{{$product->price}}" class="form-control">
                                        @error('price')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('Offer Price')}}</label>
                                    <input type="number" name="offer_price" value="{{$product->offer_price}}" class="form-control">
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
                                            <input type="date" name="offer_start_date"
                                            value="{{$product->offer_start_date}}"
                                            class="form-control">
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
                                            <input type="date" name="offer_end_date"
                                            value="{{$product->offer_end_date}}"
                                            class="form-control">
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
                                        <option {{($product->product_type == 'new') ? 'selected' : ''}}
                                        value="new">{{__('New')}} 🆕</option>
                                        <option {{($product->product_type == 'featured') ? 'selected' : ''}}
                                        value="featured">{{__('featured')}} ⭐</option>
                                        <option {{($product->product_type == 'top') ? 'selected' : ''}}
                                        value="top">{{__('top')}} 🔝</option>
                                    </select>
                                        @error('product_type')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>



                                <div class="form-group">
                                    <label class="form-label">{{__('SEO Title')}}</label>
                                    <input type="text" name="seo_title" value="{{$product->seo_title}}"
                                    class="form-control">
                                        @error('seo_title')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('SEO Description')}}</label>
                                    <textarea type="text" name="seo_description" class="form-control">
                                        {{$product->seo_description}}
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
                                        <option {{($product->status == 'active') ? 'selected' : ''}}
                                        value="active">{{__('Active')}} ✅</option>
                                        <option {{($product->status == 'inactive') ? 'selected' : ''}}
                                        value="inactive">{{__('Inactive')}} 🚫</option>
                                    </select>
                                        @error('status')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-outline-primary btn-block btn-lg">
                                        {{__('Update', ['name' => __('Product')])}}
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
