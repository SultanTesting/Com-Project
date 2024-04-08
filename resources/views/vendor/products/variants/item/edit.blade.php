@extends('vendor.layouts.main')

@section('content')

<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
        <div class="dashboard_content mt-2 mt-md-0">

            <h3><i class="far fa-store"></i>
                {{__('Edit', ['name' => __('Item')])}} -> <code> [ {{$item->name}} ] </code>
            </h3>

            <hr>

            <div class="wsus__dashboard_profile">
                <div class="wsus__dash_pro_area">

                    <form method="POST" action="{{route('vendor.item.update', $item->id)}}">
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

                        <div class="form-group mt-3">
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

                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-outline-primary">
                                {{__('Update', ['name' => __('Item')])}}
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>


@endsection

