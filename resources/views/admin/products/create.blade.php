@extends('admin.layouts.main')

@section('content')

    <section class="section">
        <div class="section-header">
            <h1>{{__('strings.Add New Product')}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                    {{__('strings.Dashboard')}}
                </a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">
                    {{__('strings.Manage Products')}}
                </a></div>
                <div class="breadcrumb-item">{{__('strings.Create')}} +</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-xl-12 col-md-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h4>{{__('strings.Create New Product')}}</h4>
                        </div>

                        <div class="card-body">

                            <form method="POST" action="{{ route('admin.products.store') }}"
                            enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3 form-group">
                                    <label for="formFileMultiple" class="form-label">{{__('strings.Thumb Image')}}</label>
                                    <input class="form-control" name="thumb_image" type="file">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('strings.Name')}}</label>
                                    <input type="text" name="name" value="{{old('name')}}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('strings.Availlable Stock')}}</label>
                                    <input type="number" min="1" name="quantity" value="{{old('quantity')}}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('strings.Short Description')}}</label>
                                    <textarea name="short_description" class="form-control">
                                        {{old('short_description')}}
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('strings.Full Description')}}</label>
                                    <textarea name="long_description" class="summernote">
                                        {{old('long_description')}}
                                    </textarea>
                                </div>

                                <div class="row">

                                    <div class="form-group col-md-4">
                                        <label class="form-label">{{__('strings.Category')}}</label>
                                        <select name="category_id" class="form-control main-category">
                                            <option selected disabled>{{__('strings.Choose First')}}</option>
                                            @foreach ($categories_view as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label class="form-label">{{__('strings.Sub-Category')}}</label>
                                        <select name="sub_category_id" class="form-control sub-category">
                                            <option selected disabled>{{__('strings.Select')}}</option>

                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label class="form-label">{{__('strings.Child-Category')}}</label>
                                        <select name="child_category_id" class="form-control child-category">
                                            <option selected disabled>{{__('strings.Select')}}</option>

                                        </select>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('strings.Brand')}}</label>
                                    <select name="brand_id" class="form-control">
                                        <option selected disabled>{{__('strings.Select')}}</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('strings.SKU')}}</label>
                                    <input type="text" name="SKU" value="{{old('SKU')}}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('strings.Price')}}</label>
                                    <input type="number" name="price" value="{{old('price')}}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('strings.Offer Price')}}</label>
                                    <input type="number" name="offer_price" value="{{old('offer_price')}}" class="form-control">
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">{{__('strings.Offer Start Date')}}</label>
                                            <input type="datetime-local" name="offer_start_date" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">{{__('strings.Offer End Date')}}</label>
                                            <input type="datetime-local" name="offer_end_date" class="form-control">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="form-group col-md-4">
                                        <label class="form-label">{{__('strings.Is Top')}}</label>
                                        <select name="top" class="form-control">
                                            <option disabled selected>{{__('strings.Select')}}</option>
                                            <option value="yes">{{__('strings.Yes')}} ✅</option>
                                            <option value="no">{{__('strings.No')}} 🚫</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label class="form-label">{{__('strings.Is Best')}}</label>
                                        <select name="best" class="form-control">
                                            <option disabled selected>{{__('strings.Select')}}</option>
                                            <option value="yes">{{__('strings.Yes')}} ✅</option>
                                            <option value="no">{{__('strings.No')}} 🚫</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label class="form-label">{{__('strings.Is Featured')}}</label>
                                        <select name="featured" class="form-control">
                                            <option disabled selected>{{__('strings.Select')}}</option>
                                            <option value="yes">{{__('strings.Yes')}} ✅</option>
                                            <option value="no">{{__('strings.No')}} 🚫</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('strings.SEO Title')}}</label>
                                    <input type="text" name="seo_title" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('strings.SEO Description')}}</label>
                                    <textarea type="text" name="seo_description" class="form-control">
                                        {{old('seo_description')}}
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label>{{__("strings.Status")}}</label>
                                    <select name="status" value="{{old('status')}}" class="form-control">
                                        <option selected disabled>{{__('strings.Select')}}</option>
                                        <option value="active">{{__('strings.Active')}} ✅</option>
                                        <option value="inactive">{{__('strings.Inactive')}} 🚫</option>
                                    </select>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-outline-primary btn-block btn-lg">
                                        {{__('strings.Create Product')}}
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
