@extends('admin.layouts.main')

@section('content')

    <section class="section">
        <div class="section-header">
            <h1>{{__('Edit', ['name' => __('Item')])}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                    {{__('Dashboard')}}
                </a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">
                    {{__('Manage Products')}}
                </a></div>
                <div class="breadcrumb-item">{{__('Edit', ['name' => __('Item')])}} </div>
            </div>
        </div>

        <div class="section-body">

            <div class="mb-4">
                <x-back-arrow :href='route("admin.product.variant-item.index",
                ["productId" => request()->product, "variantId" => request()->item->product_variants_id]
                )'/>
            </div>

            <div dir="auto" class="row">
                <div class="col-12 col-xl-12 col-md-6">
                    <div class="card">

                        <div class="card-header">
                            <h4>{{__('Edit' , ['name' => __('Item')])}} [ <code>{{$item->name}}</code> ]</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{route('admin.product.variant-item.update', $item->id)}}">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label class="form-label">{{__('Name')}}</label>
                                    <input class="form-control" type="text" name="name" value="{{$item->name}}">
                                        @error('name')
                                            <div class="text-danger font-weight-bold">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('Price')}}</label>
                                    <input class="form-control" type="number" name="price" value="{{$item->price}}">
                                        @error('price')
                                            <div class="text-danger font-weight-bold">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label>{{__("Default")}}</label>
                                    <select name="default" class="form-control">
                                        <option {{($item->default == 'yes') ? 'selected' : ''}}
                                        value="yes">{{__('Yes')}} ✅</option>
                                        <option {{($item->default == 'no') ? 'selected' : ''}}
                                        value="no">{{__('No')}} 🚫</option>
                                    </select>
                                        @error('default')
                                            <div class="text-danger font-weight-bold">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label>{{__("Status")}}</label>
                                    <select name="status" class="form-control">
                                        <option {{($item->status == 'active') ? 'selected' : ''}}
                                        value="active">{{__('Active')}} ✅</option>
                                        <option {{($item->status == 'inactive') ? 'selected' : ''}}
                                        value="inactive">{{__('Inactive')}} 🚫</option>
                                    </select>
                                        @error('status')
                                            <div class="text-danger font-weight-bold">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <input type="hidden" name="product" value="{{request()->product}}">
                                <input type="hidden" name="variant" value="{{$item->product_variants_id}}">

                                <button type="submit" class="btn btn-block btn-outline-primary">
                                    {{__('Update', ['name' => __('Item')])}}
                                </button>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection

