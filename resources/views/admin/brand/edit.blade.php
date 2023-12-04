@extends('admin.layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{__('strings.Edit Brand')}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                {{__('strings.Dashboard')}}
            </a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.brand.index') }}">
                {{__('strings.Manage Products')}}
            </a></div>
            <div class="breadcrumb-item">{{__('strings.Edit')}}</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12 col-xl-12 col-md-6">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h4>{{__('strings.Edit')}} [ {{$brand->name}} {{__('strings.Brand')}} ]</h4>
                    </div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('admin.brand.update', $brand->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @if ($brand->logo)
                                <div class="form-group">
                                    <img src="{{$brand->logo}}" class="img-thumbnail" width="200px"/>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="logo" class="form-label">{{__('strings.Logo')}}</label>
                                <input type="file" name="logo" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="name">{{__('strings.Brand Name')}}</label>
                                <input type="text" class="form-control" name="name" value="{{$brand->name}}">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="featured">{{__('strings.Is Featured')}}</label>
                                <select name="featured" class="form-control">
                                    <option disabled selected>{{__('strings.Select')}}</option>
                                    <option {{$brand->featured == 'Yes' ? 'selected' : ''}}
                                     value="Yes">
                                        {{__('strings.Yes')}}
                                    </option>
                                    <option {{$brand->featured == 'No' ? 'selected' : ''}}
                                     value="No">
                                        {{__('strings.No')}}
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">{{__('strings.Status')}}</label>
                                <select name="status" class="form-control">
                                    <option disabled selected>{{__('strings.Select')}}</option>
                                    <option {{$brand->status == 'Active' ? 'selected' : ''}}
                                        value='Active'>
                                        {{__('strings.Active')}}
                                    </option>
                                    <option {{$brand->status == 'Inactive' ? 'selected' : ''}}
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
