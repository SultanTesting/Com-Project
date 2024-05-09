@extends('admin.layouts.main')

@section('content')

    <section class="section">
        <div class="section-header">
            <h1>{{__('Edit', ['name' => __('shipment')])}}</h1>
            <div class="breadcrumb section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                    {{__('Dashboard')}}
                </a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.shipping.index') }}">
                    {{__('Shipping Center')}}
                </a></div>
                <div class="breadcrumb-item">{{__('shipment')}}</div>
            </div>
        </div>

        <div class="section-body">

            <div class="mb-4">
                <x-back-arrow :href='route("admin.shipping.index")'/>
            </div>

            <div class="row">
                <div class="col-12 col-xl-12 col-md-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h4>{{__('Edit', ['name' => $shipment->name])}}</h4>
                        </div>

                        <div class="card-body">

                            <form action="{{route('admin.shipping.update', $shipment->id)}}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label class="form-label">{{__('Name')}}</label>
                                    <input type="text" class="form-control" name="name" value="{{$shipment->name}}">
                                    <x-input-error :messages="$errors->get('name')" class="alert-danger mb-2"/>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('Cost')}}</label>
                                    <input type="text" class="form-control" name="cost" value="{{$shipment->cost}}">
                                    <x-input-error :messages="$errors->get('cost')" class="alert-danger mb-2"/>
                                </div>


                                <div class="form-group">
                                    <label class="form-label">{{__('Type')}}</label>
                                    <select name="type" class="form-control form-select ship_type">
                                        <option selected disabled>{{__('Select')}}</option>
                                        <option {{($shipment->type == 'basic') ? 'selected' : ''}}
                                        value="basic">{{__('Basic')}}</option>
                                        <option {{($shipment->type == 'subscription') ? 'selected' : ''}}
                                        value="subscription">{{__('MemberShip')}}</option>
                                        <option {{($shipment->type == 'min_amount') ? 'selected' : ''}}
                                        value="min_amount">
                                            {{__('Minimum Order Amount')}}
                                        </option>
                                    </select>
                                    <x-input-error :messages="$errors->get('type')" class="alert-danger mb-2"/>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">{{__('Minimum Amount')}}</label>
                                    <input {{($shipment->min_cost) ? '' : 'disabled'}}
                                    type="text" class="form-control min_cost" name="min_cost" value="{{$shipment->min_cost}}">
                                    <x-input-error :messages="$errors->get('min_cost')" class="alert-danger mb-2"/>
                                </div>


                                <div class="form-group">
                                    <label class="form-label">{{__('Status')}}</label>
                                    <select class="form-control form-select" name="status">
                                        <option selected disabled>{{__('Select')}}</option>
                                        <option {{($shipment->status == 'active') ? 'selected' : ''}}
                                        value="active">{{__('Active')}}</option>
                                        <option {{($shipment->status == 'inactive') ? 'selected' : ''}}
                                        value="inactive">{{__('Inactive')}}</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('status')" class="alert-danger mb-2"/>
                                </div>

                                <button type="submit" class="btn btn-outline-primary btn-block">
                                    {{__('Update', ['name' => __('shipment')])}}
                                </button>

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
        $(document).ready(function() {
            $('body').on('change', '.ship_type', function()
        {
            let value = $(this).val();

            if(value == 'min_amount')
            {
                $('.min_cost').removeAttr("disabled");
            }else{
                $('.min_cost').prop("disabled", true);
            }
        })
        })
    </script>

@endpush
