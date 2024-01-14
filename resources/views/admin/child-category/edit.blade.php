@extends('admin.layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{__('Edit Child-Category')}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                {{__('Dashboard')}}
            </a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">
                {{__('Manage Categories')}}
            </a></div>
            <div class="breadcrumb-item">{{__('Edit')}}</div>
        </div>
    </div>

    <div class="section-body">

        <div class="mb-4">
            <x-back-arrow :href='route("admin.child-category.index")'/>
        </div>

        <div class="row">
            <div class="col-12 col-xl-12 col-md-6">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h4>{{__('Edit')}} [ {{$childCategory->name}}  ]</h4>
                    </div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('admin.child-category.update', $childCategory->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">{{__('Child-Category Name')}}</label>
                                <input type="text" class="form-control" name="name" value="{{$childCategory->name}}">
                                <x-input-error :messages="$errors->get('name')" class="alert-danger mb-2"/>
                            </div>

                            <div class="form-group">
                                <label class="form-label">{{__('Category')}}</label>
                                <select name="category_id" class="form-control main-category">
                                    @foreach ($category as $cat)
                                        <option {{$cat->id == $childCategory->category_id ? 'selected' : ''}}
                                        value="{{$cat->id}}">{{$cat->name}}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('category_id')" class="alert-danger mb-2"/>
                            </div>

                            <div class="form-group">
                                <label class="form-label">{{__('Sub-Category')}}</label>
                                <select name="sub_category_id" class="form-control sub-category">
                                    @foreach ($subCategory as $sub)
                                        <option {{$sub->id == $childCategory->sub_category_id ? 'selected' : ''}}
                                        value="{{$sub->id}}">{{$sub->name}}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('sub_category_id')" class="alert-danger mb-2"/>
                            </div>

                            <div class="form-group">
                                <label class="form-label">{{__('Status')}}</label>
                                <select name="status" class="form-control">

                                    <option {{$childCategory->status == 'Active' ? 'selected' : ''}}
                                        value='Active'>
                                        {{__('Active')}}
                                    </option>
                                    <option {{$childCategory->status == 'Inactive' ? 'selected' : ''}}
                                        value='Inactive'>
                                        {{__('Inactive')}}
                                    </option>

                                </select>
                                <x-input-error :messages="$errors->get('status')" class="alert-danger mb-2"/>
                            </div>


                            <div class="mt-4">
                                <button type="submit" class="btn btn-outline-primary btn-lg btn-block">
                                    {{__('Update')}}
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
        var myUrl = "{{route('admin.get-subCategories')}}";
    </script>

    <script src="{{ asset('backend/assets/js/categories-view.js') }}"></script>

@endpush
