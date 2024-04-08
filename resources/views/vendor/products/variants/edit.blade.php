@extends('vendor.layouts.main')

@section('content')

<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
        <div class="dashboard_content mt-2 mt-md-0">

            <h3><i class="far fa-store"></i>
                {{__('Edit', ['name' => __('Variants')])}} -> <code> [ {{$variant->name}} ] </code>
            </h3>

            <hr>

            <div class="wsus__dashboard_profile">
                <div class="wsus__dash_pro_area">

                    <form method="POST"
                        action="{{ route('vendor.variants.update', $variant->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name" class="form-label">{{__('Variant Name')}}</label>
                            <input type="text" class="form-control" name="name" value="{{$variant->name}}">
                            <x-input-error :messages="$errors->get('name')"/>
                        </div>

                        <div class="form-group">
                            <label for="status" class="form-label">{{__('Status')}}</label>
                            <select name="status" class="form-control">
                                <option selected disabled>{{__('Select')}}</option>
                                <option {{($variant->status == 'active') ? 'selected' : ''}}
                                value="active">{{__('Active')}}</option>
                                <option {{($variant->status == 'inactive') ? 'selected' : ''}}
                                value="inactive">{{__('Inactive')}}</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')"/>
                        </div>

                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-outline-primary">
                                {{__('Update', ['name' => __('Variants')])}}
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>


@endsection
