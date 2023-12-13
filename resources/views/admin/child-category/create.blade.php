@extends('admin.layouts.main')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{__('Add New Child-Category')}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                    {{__('Dashboard')}}
                </a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">
                    {{__('Manage Categories')}}
                </a></div>
                <div class="breadcrumb-item">{{__('Create')}} +</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-xl-12 col-md-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h4>{{__('New Child-Category')}}</h4>
                        </div>

                        <div class="card-body">

                            <form method="POST"
                                action="{{ route('admin.child-category.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="name" class="form-label">{{__('Child-Category Name')}}</label>
                                    <input type="text" class="form-control" name="name" value="{{old('name')}}">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('Category')}}</label>
                                    <select name="category_id" class="form-control main-category">
                                        <option disabled selected>{{__('Select')}}</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('Sub-Category')}}</label>
                                    <select name="sub_category_id" class="form-control sub-category">
                                        <option selected disabled>{{__('Select')}}</option>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="status" class="form-label">{{__('Status')}}</label>
                                    <select name="status" class="form-control">
                                        <option selected disabled>{{__('Select')}}</option>
                                        <option value="Active">{{__('Active')}}</option>
                                        <option value="Inactive">{{__('Inactive')}}</option>
                                    </select>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-block btn-outline-primary">
                                        {{__('Add New Child-Category')}}
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

    <script src="{{ asset('backend/assets/js/sub-categories-view.js') }}"></script>

@endpush
