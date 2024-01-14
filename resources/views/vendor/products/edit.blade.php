@extends('vendor.layouts.main')

@section('content')

    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content mt-2 mt-md-0">

                <h3><i class="far fa-plus"></i> {{__('Create New', ['name' => __('Product')])}}</h3>

                <hr>

                <x-back-arrow :href='route("vendor.products.index")'/>


                <div class="wsus__dashboard_profile">
                    <div class="wsus__dash_pro_area">

                        <form method="POST" action="{{ route('vendor.products.update', $product->id) }}"
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
                                    <x-input-error :messages="$errors->get('thumb_image')" class="alert-danger" />
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('Name')}}</label>
                                    <input type="text" name="name" value="{{$product->name}}" class="form-control">
                                    <x-input-error :messages="$errors->get('name')" class="alert-danger" />
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('Availlable Stock')}}</label>
                                    <input type="number" min="1" name="quantity" value="{{$product->quantity}}" class="form-control">
                                    <x-input-error :messages="$errors->get('quantity')" class="alert-danger" />
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">{{__('Short Description')}}</label>
                                    <textarea name="short_description" class="form-control">{{$product->short_description}}
                                    </textarea>                                                                      <x-input-error :messages="$errors->get('short_description')" class="alert-danger" />
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">{{__('Full Description')}}</label>
                                    <textarea name="long_description" class="summernote">{{$product->long_description}}
                                    </textarea>
                                    <x-input-error :messages="$errors->get('long_description')" class="alert-danger" />

                                </div>

                                <div class="row mb-3">

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
                                        <x-input-error :messages="$errors->get('category_id')" class="alert-danger" />

                                    </div>

                                    <div class="form-group col-md-4">
                                        <label class="form-label">{{__('Sub-Category')}}</label>
                                        <select name="sub_category_id" class="form-control sub-category">
                                            @foreach ($subCategories as $sub)
                                                <option {{($sub->id == $product->sub_category_id) ? 'selected' : ''}}
                                                    value="{{$sub->id}}">{{$sub->name}}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('sub_category_id')" class="alert-danger" />
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label class="form-label">{{__('Child-Category')}}</label>
                                        <select name="child_category_id" class="form-control child-category">
                                            @foreach ($childCategories as $child)
                                                <option {{($child->id == $product->child_category_id) ? 'selected' : ''}}
                                                    value="{{$child->id}}">{{$child->name}}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('child_category_id')" class="alert-danger" />

                                    </div>

                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">{{__('Brand')}}</label>
                                    <select name="brand_id" class="form-control">
                                        <option selected disabled>{{__('Select')}}</option>
                                        @foreach ($brands as $brand)
                                            <option {{($brand->id == $product->brand_id) ? 'selected' : ''}}
                                            value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('brand_id')" class="alert-danger" />

                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('SKU')}}</label>
                                    <input type="text" name="SKU" value="{{$product->SKU}}" class="form-control">
                                    <x-input-error :messages="$errors->get('SKU')" class="alert-danger" />

                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('Price')}}</label>
                                    <input type="number" name="price" value="{{$product->price}}" class="form-control">
                                    <x-input-error :messages="$errors->get('price')" class="alert-danger" />

                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('Offer Price')}}</label>
                                    <input type="number" name="offer_price" value="{{$product->offer_price}}" class="form-control">
                                    <x-input-error :messages="$errors->get('offer_price')" class="alert-danger" />
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">{{__('Offer Start Date')}}</label>
                                            <input type="date" name="offer_start_date"
                                            value="{{$product->offer_start_date}}"
                                            class="form-control">
                                            <x-input-error :messages="$errors->get('offer_start_date')" class="alert-danger" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">{{__('Offer End Date')}}</label>
                                            <input type="date" name="offer_end_date"
                                            value="{{$product->offer_end_date}}"
                                            class="form-control">
                                            <x-input-error :messages="$errors->get('offer_end_date')" class="alert-danger" />

                                        </div>
                                    </div>

                                </div>


                                <div class="form-group mb-3">
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
                                        <x-input-error :messages="$errors->get('product_type')" class="alert-danger" />

                                </div>



                                <div class="form-group">
                                    <label class="form-label">{{__('SEO Title')}}</label>
                                    <input type="text" name="seo_title" value="{{$product->seo_title}}"
                                    class="form-control">
                                    <x-input-error :messages="$errors->get('seo_title')" class="alert-danger" />

                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">{{__('SEO Description')}}</label>
                                    <textarea type="text" name="seo_description" class="form-control" />{{$product->seo_description}}
                                    </textarea>
                                    <x-input-error :messages="$errors->get('seo_description')" class="alert-danger" />

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
                                    <x-input-error :messages="$errors->get('status')" class="alert-danger" />

                                </div>

                                <div class="mt-4 d-grid">
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

@endsection

@push('scripts')

    <script>
        var myUrl = "{{route('vendor.product.subCategories')}}";
        var childUrl = "{{route('vendor.product.childCategories')}}";
    </script>

    {{-- Get Sub-Categories AJAX --}}
    <script src="{{ asset('backend/assets/js/sub-categories-view.js') }}"></script>

    {{-- Get Child-Categories AJAX --}}
    <script src="{{ asset('backend/assets/js/child-categories.js') }}"></script>

@endpush
