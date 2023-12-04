@extends('admin.layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{__('strings.Edit Category')}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                {{__('strings.Dashboard')}}
            </a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">
                {{__('strings.Manage Website')}}
            </a></div>
            <div class="breadcrumb-item">{{__('strings.Edit')}}</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12 col-xl-12 col-md-6">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h4>{{__('strings.Edit')}} [ {{$category->name}} {{__('strings.Category')}} ]</h4>
                    </div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('admin.category.update', $category->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @if ($category->icon)
                                <div class="form-group">
                                    <i class="{{$category->icon}} img-thumbnail " style='font-size: 55px'></i>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="icon" class="form-label">{{__('strings.Category Icon')}}</label>
                                <button name="icon"
                                class="btn btn-primary btn-block" data-placement="bottom" data-icon="{{$category->icon}}" data-unselected-class="btn-info" role="iconpicker"></button>
                            </div>

                            <div class="form-group">
                                <label for="name">{{__('strings.Category Name')}}</label>
                                <input type="text" class="form-control" name="name" value="{{$category->name}}">
                            </div>

                            <div class="form-group">
                                <label class="form-label">{{__('strings.Status')}}</label>
                                <select name="status" class="form-control">
                                    <option selected disabled>{{__('strings.Select')}}</option>
                                    <option {{$category->status == 'Active' ? 'selected' : ''}}
                                        value='Active'>
                                        {{__('strings.Active')}}
                                    </option>
                                    <option {{$category->status == 'Inactive' ? 'selected' : ''}}
                                        value='Inactive'>
                                        {{__('strings.Inactive')}}
                                    </option>
                                </select>
                            </div>


                            <div class="mt-4">
                                <button type="submit" class="btn btn-outline-primary btn-lg btn-block">
                                    {{__('strings.Update')}}
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
