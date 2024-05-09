@section('title', "$settings->site_name || Vendor Shop Profile")

@extends('vendor.layouts.main')

@section('content')

<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
        <div class="dashboard_content mt-2 mt-md-0">

            <h3><i class="far fa-user me-2 ms-1"></i> {{__('Shop Profile')}} </h3>
            <hr>

            <div class="wsus__dashboard_profile">
                <div class="wsus__dash_pro_area">

                    <form method="POST" action="{{route('vendor.shop-profile.update', $vendor->id)}}"
                        enctype="multipart/form-data" >
                        @csrf
                        @method('PUT')

                        <div class="form-group" style="margin-bottom: 10px">
                            <label class="font-weight-bold">{{__('Image Preview')}}</label>
                            <br>
                            <img src="{{($vendor->banner)
                            ? asset($vendor->banner) : asset('frontend/images/no-image.jpg')}}" width="25%" class="img-thumbnail">
                        </div>

                        <div class="mb-3 form-group">
                            <label for="formFileMultiple" class="form-label">{{__('Upload', ['name' => __('Banner')])}}</label>
                            <input class="form-control" name="banner" type="file" id="formFileMultiple"
                                multiple>
                            <x-input-error :messages="$errors->get('banner')" class="alert-danger mb-2"/>
                        </div>

                        <div class="form-group">
                            <label class="form-label">{{__('Name')}}</label>
                            <input type="text" name="name" value="{{$vendor->name}}" class="form-control">
                            <x-input-error :messages="$errors->get('name')" class="alert-danger mb-2"/>
                        </div>

                        <div class="form-group">
                            <label class="form-label">{{__('Email')}}</label>
                            <input type="text" name="email" value="{{$vendor->email}}" class="form-control">
                            <x-input-error :messages="$errors->get('email')" class="alert-danger mb-2"/>
                        </div>

                        <div class="form-group ">
                            <label>{{__('Phone')}}</label>
                            <input type="text" name="phone" value="{{$vendor->phone}}" class="form-control">
                            <x-input-error :messages="$errors->get('phone')" class="alert-danger mb-2"/>
                        </div>

                        <div class="form-group">
                            <label>{{__('Address')}}</label>
                            <input type="text" name="address" value="{{$vendor->address}}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>{{__('Short Description')}}</label>
                            <textarea name="shop_description" class="summernote"> {{$vendor->shop_description}} </textarea>
                            <x-input-error :messages="$errors->get('shop_description')" class="alert-danger mb-2"/>
                        </div>

                        <div class="form-group">
                            <label for="facebook">{{__('Facebook')}}</label>
                            <input type="url" name="facebook" value="{{$vendor->facebook}}"
                            class="form-control" placeholder="https://facebook.com/vendor_profile">
                            <x-input-error :messages="$errors->get('facebook')" class="alert-danger mb-2"/>

                        </div>

                        <div class="form-group">
                            <label for="x">{{__('X')}}</label>
                            <input type="url" name="x" value="{{$vendor->x}}"
                            class="form-control" placeholder="https://x.com/vendor_profile">
                            <x-input-error :messages="$errors->get('x')" class="alert-danger mb-2"/>
                        </div>

                        <div class="form-group">
                            <label for="instagram">{{__('Instagram')}}</label>
                            <input type="url" name="instagram" value="{{$vendor->instagram}}"
                            class="form-control" placeholder="https://instagram.com/vendor_profile">
                            <x-input-error :messages="$errors->get('instagram')" class="alert-danger mb-2"/>
                        </div>

                        <div class="form-group">
                            <label>{{__('Status')}}</label>
                            <select class="form-control" name="store_status">
                                <option selected disabled>{{__('Select')}}</option>
                                <option {{$vendor->store_status == 'Open' ? 'selected' : ''}}
                                    value="Open">{{__('Open')}}</option>
                                <option {{$vendor->store_status == 'Close' ? 'selected' : ''}}
                                    value="Close">{{__('Close')}}</option>
                                <option {{$vendor->store_status == 'Permanently_Closed' ? 'selected' : ''}} value="Permanently_Closed">{{__('Permanently Closed')}}</option>
                            </select>
                            <x-input-error :messages="$errors->get('store_status')" class="alert-danger mb-2" />
                        </div>

                        <div class="mt-4 form-group">
                            <button type="submit" class="btn btn-outline-primary">
                                {{__('Submit')}}
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>


@endsection
