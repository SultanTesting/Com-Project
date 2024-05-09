@extends('frontend.dashboard.layouts.main')

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
        <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="fal fa-gift-card"></i>
                {{__('Update', ['name' => __('Address')])}}  <code>[ {{$address->name}} ]</code>
            </h3>
            <div class="wsus__dashboard_add wsus__add_address">

                <form action="{{route('user.address.update', $address->id)}}" method="POST">
                @csrf
                @method('PUT')

                    <div class="row">
                        <div class="col-xl-6 col-md-6">
                            <div class="wsus__add_address_single">
                            <label>{{__('Name')}} <b>*</b></label>
                            <input type="text" placeholder="{{__('Name')}}" name="name"
                            value='{{old('name', $address->name)}}'>
                            <x-input-error :messages="$errors->get('name')" class="alert-danger mb-2"/>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="wsus__add_address_single">
                            <label>{{__('Email')}}</label>
                            <input type="email" placeholder="{{__('Email')}}" name="email"
                            value='{{old('email', $address->email)}}'>
                            <x-input-error :messages="$errors->get('email')" class="alert-danger mb-2"/>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="wsus__add_address_single form-group">
                                <label>{{__('Phone')}} <b>*</b></label>

                                <input type="number" name="phone"
                                value='{{old('phone', $address->phone)}}'>
                                <x-input-error :messages="$errors->get('phone')" class="alert-danger mb-2"/>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="wsus__add_address_single">
                            <label>{{__('Country')}} <b>*</b></label>
                            <div class="wsus__topbar_select">
                                <select class="select_2" name="country">
                                    <option disabled selected>{{__('Select')}}</option>
                                    @foreach (config('settings.country_list') as $country)
                                        <option {{($address->country == $country) ? 'selected' : ''}}
                                        value="{{$country}}">{{$country}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <x-input-error :messages="$errors->get('country')" class="alert-danger mb-2"/>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="wsus__add_address_single">
                            <label>{{__('State')}} <b>*</b></label>
                            <input type="text" name="state" placeholder="{{__('State')}}"
                            value='{{old('state', $address->state)}}'>
                            <x-input-error :messages="$errors->get('state')" class="alert-danger mb-2"/>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="wsus__add_address_single">
                            <label>{{__('City')}} <b>*</b></label>
                            <input type="text" name="city" placeholder="{{__('City')}}"
                            value='{{old('city', $address->city)}}'>
                            <x-input-error :messages="$errors->get('city')" class="alert-danger mb-2"/>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="wsus__add_address_single">
                            <label>{{__('Zip Code')}} <b>*</b></label>
                            <input type="text" placeholder="{{__('Zip Code')}}" name="zip_code"
                            value='{{old('zip_code', $address->zip_code)}}'>
                            <x-input-error :messages="$errors->get('zip_code')" class="alert-danger mb-2"/>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="wsus__add_address_single">
                            <label>{{__('Address')}} <b>*</b></label>
                            <input type="text" name="address" value='{{old('address', $address->address)}}'
                            placeholder="{{__('Ex: 21 - Hay 2 - District 3 - Fifth Settlement - New Cairo')}}">
                            <x-input-error :messages="$errors->get('address')" class="alert-danger mb-2"/>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="wsus__add_address_single">
                            <label>{{__('Comment')}}</label>
                            <textarea cols="3" rows="5" placeholder="Type Your Comment" name="comment"> {{$address->comment}}
                            </textarea>
                            </div>
                            <x-input-error :messages="$errors->get('comment')" class="alert-danger mb-2"/>
                        </div>
                        <div class="col-xl-6">
                            <button type="submit" class="common_btn">
                                {{__('Update', ['name' => __('Address')])}}
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        </div>
    </div>
@endsection
