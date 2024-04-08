@extends('admin.layouts.main')

@section('content')

    <section class="section">
        <div class="section-header">
            <h1>{{__('Edit', ['name' => __('Coupon')])}}</h1>
            <div class="breadcrumb section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                    {{__('Dashboard')}}
                </a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.coupon.index') }}">
                    {{__('Coupons')}}
                </a></div>
                <div class="breadcrumb-item">{{__('Edit', ['name' => __('Coupon')])}}</div>
            </div>
        </div>

        <div class="section-body">

            <div class="mb-4">
                <x-back-arrow :href='route("admin.coupon.index")'/>
            </div>

            <div class="row">
                <div class="col-12 col-xl-12 col-md-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h4>{{__('Edit', ['name' => __('Coupon')])}} [ <code>{{$coupon->name}}</code> ]</h4>
                        </div>

                        <div class="card-body">
                            <form action="{{route('admin.coupon.update', $coupon->id)}}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label class="form-label">{{__('Coupon Name')}}</label>
                                    <input type="text" class="form-control" name="name" value="{{$coupon->name}}">
                                    <x-input-error :messages="$errors->get('name')" class="alert-danger mb-2"/>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('Code')}}</label>
                                    <input type="text" class="form-control" name="code" value="{{$coupon->code}}">
                                    <x-input-error :messages="$errors->get('code')" class="alert-danger mb-2"/>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label">{{__('Quantity')}}</label>
                                        <input type="number" class="form-control" name="quantity"
                                        value="{{$coupon->quantity}}">
                                        <x-input-error :messages="$errors->get('quantity')" class="alert-danger mb-2"/>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="form-label">{{__('Maximum usage per user')}}</label>
                                        <input type="number" class="form-control" name="max_use"
                                        value="{{$coupon->max_use}}">
                                        <x-input-error :messages="$errors->get('max_use')" class="alert-danger mb-2"/>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label">{{__('Start Date')}}</label>
                                        <input type="datetime-local" name="start_date" class="form-control"
                                        value="{{$coupon->start_date}}">
                                        <x-input-error :messages="$errors->get('start_date')" class="alert-danger mb-2"/>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="form-label">{{__('End Date')}}</label>
                                        <input type="datetime-local" name="end_date" class="form-control"
                                        value="{{$coupon->end_date}}">
                                        <x-input-error :messages="$errors->get('end_date')" class="alert-danger mb-2"/>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label class="form-label">{{__('Discount')}}</label>
                                        <input type="number" name="discount" class="form-control"
                                        value="{{$coupon->discount}}">
                                        <x-input-error :messages="$errors->get('discount')" class="alert-danger mb-2"/>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label class="form-label">{{__('Discount Type')}}</label>
                                        <select name="discount_type" class="form-control form-select">
                                            <option selected disabled>{{__('Select')}}</option>
                                            <option {{($coupon->discount_type == 'percentage') ? 'selected' : ''}}
                                            value="percentage">{{__('Percentage')}} %</option>
                                            <option {{($coupon->discount_type == 'cash') ? 'selected' : ''}}
                                            value="cash">{{__('Cash Discount')}} [{{$settings->currency_icon}}]</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('discount_type')" class="alert-danger mb-2"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('Status')}}</label>
                                    <select class="form-control form-select" name="status">
                                        <option selected disabled>{{__('Select')}}</option>
                                        <option {{($coupon->status == 'active') ? 'selected' : ''}}
                                        value="active">{{__('Active')}}</option>
                                        <option {{($coupon->status == 'inactive') ? 'selected' : ''}}
                                        value="inactive">{{__('Inactive')}}</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('status')" class="alert-danger mb-2"/>
                                </div>

                                <button type="submit" class="btn btn-outline-primary btn-block">
                                    {{__('Update', ['name' => __('Coupon')])}}
                                </button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection
