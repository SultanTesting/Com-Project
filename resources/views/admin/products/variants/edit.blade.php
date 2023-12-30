@extends('admin.layouts.main')

@section('content')

    <section class="section">
        <div class="section-header">
            <h1>{{__('Edit', ['name' => __('Variant')])}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                    {{__('Dashboard')}}
                </a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">
                    {{__('Manage Products')}}
                </a></div>
                <div class="breadcrumb-item">{{__('Edit', ['name' => __('Variant')])}} </div>
            </div>
        </div>

        <div class="section-body">

            <div class="mb-4">
                    <x-back-arrow :href='route("admin.product-variants.index"),
                    ["product" => $variant->product->id]'/>
                </a>
            </div>

            <div dir="auto" class="row">
                <div class="col-12 col-xl-12 col-md-6">
                    <div class="card">

                        <div class="card-header">
                            <h4>{{__('Edit' , ['name' => __('Variant')])}} [ <code>{{$variant->name}}</code> ]</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{route('admin.product-variants.update', $variant->id)}}">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label class="form-label">{{__('Name')}}</label>
                                    <input class="form-control" type="text" name="name" value="{{$variant->name}}">
                                        @error('name')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label>{{__("Status")}}</label>
                                    <select name="status" class="form-control">
                                        <option {{($variant->status == 'active') ? 'selected' : ''}}
                                        value="active">{{__('Active')}} ✅</option>
                                        <option {{($variant->status == 'inactive') ? 'selected' : ''}}
                                        value="inactive">{{__('Inactive')}} 🚫</option>
                                    </select>
                                        @error('status')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <button type="submit" class="btn btn-block btn-outline-primary">
                                    {{__('Update', ['name' => __('Variant')])}}
                                </button>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection

