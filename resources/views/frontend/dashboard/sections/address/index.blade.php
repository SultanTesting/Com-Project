@section('title', "$settings->site_name || Addresses")

@extends('frontend.dashboard.layouts.main')

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
        <div class="dashboard_content">
            <h3><i class="fal fa-gift-card"></i> {{__('Addresses')}}</h3>
            <div class="wsus__dashboard_add">
                <div class="row">

                    @if (count($userAddress) > 0)
                        @foreach ($userAddress as $address)
                        <div class="col-xl-6">
                            <div class="wsus__dash_add_single">
                                <h4>{{__('Billing Address')}}
                                    <span class="text-danger">{{($address->default === 'yes') ? 'Default' : ''}}</span>
                                </h4>
                                <ul>
                                <li><span>{{__('Name')}} :</span> {{$address->name}}</li>
                                <li><span>{{__('Phone')}} :</span> {{$address->phone}}</li>
                                <li><span>{{__('Email')}} :</span> {{$address->email}}</li>
                                <li><span>{{__('Country')}} :</span> {{$address->country}}</li>
                                <li><span>{{__('City')}} :</span> {{$address->city}}</li>
                                <li><span>{{__('Zip Code')}} :</span> {{$address->zip_code}}</li>
                                <li><span>{{__('Address')}} :</span> {{$address->address}}</li>
                                <li><span>{{__('Comment')}} :</span> {{$address->comment}}</li>
                                </ul>
                                <div class="wsus__address_btn">
                                <a href="{{route('user.address.edit', $address->id)}}" class="edit">
                                    <i class="fal fa-edit"></i>
                                    {{__('Edit', ['name' => __('Address')])}}
                                </a>
                                <a href="{{route('user.address.destroy', $address->id)}}" class="del delete-item">
                                    <i class="fal fa-trash-alt"></i>
                                    {{__('Delete')}}</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="container-fluid">
                            <div class="col-12 col-md-6 col-lg-12">
                                @include('components.empty-state')
                            </div>
                        </div>
                    @endif

                </div>
                <div class="col-12 mt-4">
                    <a href="{{route('user.address.create')}}" class="add_address_btn common_btn">
                        <i class="far fa-plus"></i>
                        {{__('Add New', ['name' => __('Address')])}}
                    </a>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
