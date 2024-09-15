@extends('frontend.dashboard.layouts.main')

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
        <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="fal fa-gift-card"></i>{{__('Create New', ['name' => __('Address')])}}</h3>
            <div class="wsus__dashboard_add wsus__add_address">

                <form action="{{route('user.address.store')}}" method="POST">
                @csrf

                    <div class="row">
                        <div class="col-xl-6 col-md-6">
                            <div class="wsus__add_address_single">
                            <label>{{__('Name')}} <b>*</b></label>
                            <input type="text" placeholder="{{__('Name')}}" name="name">
                            <x-input-error :messages="$errors->get('name')" class="alert-danger mb-2"/>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="wsus__add_address_single">
                            <label>{{__('Email')}}</label>
                            <input type="email" placeholder="{{__('Email')}}" name="email">
                            <x-input-error :messages="$errors->get('email')" class="alert-danger mb-2"/>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="wsus__add_address_single">
                            <label>{{__('Phone')}} <b>*</b></label>
                            <input type="text" placeholder="{{__('Phone')}}" name="phone">
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
                                        <option value="{{$country}}">{{$country}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <x-input-error :messages="$errors->get('country')" class="alert-danger mb-2"/>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="wsus__add_address_single">
                            <label>{{__('State')}} <b>*</b></label>
                            <input type="text" name="state" placeholder="{{__('State')}}">
                            <x-input-error :messages="$errors->get('state')" class="alert-danger mb-2"/>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="wsus__add_address_single">
                            <label>{{__('City')}} <b>*</b></label>
                            <input type="text" name="city" placeholder="{{__('City')}}">
                            <x-input-error :messages="$errors->get('city')" class="alert-danger mb-2"/>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="wsus__add_address_single">
                            <label>{{__('Zip Code')}} <b>*</b></label>
                            <input type="text" placeholder="{{__('Zip Code')}}" name="zip_code">
                            <x-input-error :messages="$errors->get('zip_code')" class="alert-danger mb-2"/>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="wsus__add_address_single">
                            <label>{{__('Address')}} <b>*</b></label>
                            <input type="text" name="address"
                            placeholder="{{__('Ex: 21 - Hay 2 - District 3 - Fifth Settlement - New Cairo')}}">
                            <x-input-error :messages="$errors->get('address')" class="alert-danger mb-2"/>
                            </div>
                        </div>
                        <div class="col-xl-12 d-flex justify-content-center">
                            <div class="wsus__add_address_single">
                                <label>{{__('Make It Default')}} <b>*</b></label>

                                <input type="radio" class="btn-check" name="default" id="success-outlined" autocomplete="off" value="yes">
                                <label class="btn btn-outline-success" for="success-outlined">{{__('Yes')}}</label>

                                <input type="radio" class="btn-check" name="default" id="danger-outlined" autocomplete="off" checked value="no">
                                <label class="btn btn-outline-danger" for="danger-outlined">{{__('No')}}</label>

                                <x-input-error :messages="$errors->get('default')" class="alert-danger mb-2"/>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="wsus__add_address_single">
                            <label>{{__('Comment')}}</label>
                            <textarea cols="3" rows="5" placeholder="Type Your Comment" name="comment"></textarea>
                            <x-input-error :messages="$errors->get('comment')" class="alert-danger mb-2"/>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <button type="submit" class="common_btn">
                                {{__('Add New', ['name' => __('Address')])}}
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        </div>
    </div>
@endsection
