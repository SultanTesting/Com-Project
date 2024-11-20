@section('title', "$settings->site_name || User Orders")

@extends('frontend.dashboard.layouts.main')

@section('content')

<div id="printable" class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
        <div class="dashboard_content ">
            <div class="d-flex justify-content-between">
                <div>{{__('Order')}} : [ <code class="fs-5">#{{$order->invoice_id}}</code> ]</div>
                <code class="fs-5">{{date('d M, Y', strtotime($order->created_at))}}</code>
            </div>
            <hr>

            <div class="wsus__invoice_area">
                <div  class="wsus__invoice_header">
                    <div class="wsus__invoice_content">
                        <div class="row">
                            <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                <div class="wsus__invoice_single">
                                    <h5>{{__('Billed To')}}</h5>
                                    <h6>{{$address->name}}</h6>
                                    <p>{{$address->email}}</p>
                                    <p>{{$address->phone}}</p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                <div class="wsus__invoice_single text-md-center">
                                    <h5>{{__('Shipping Address')}}</h5>
                                    <h6> {{$address->name}} </h6>
                                    <p> {{$address->email}} </p>
                                    <p> {{$address->address}} </p>
                                    <p> {{$address->city}}, {{$address->country}} </p>
                                    <p> {{$address->zip_code}} </p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4">
                                <div class="wsus__invoice_single text-md-end">
                                    <h5>{{__('Payment Details')}}</h5>
                                    <h6>{{__('Name')}} : {{$address->name}}</h6>
                                    <p>{{__('Payment Method')}} : {{$order->payment_method}}</p>
                                    <p>
                                        {{__('Payment Status')}} :
                                        {{
                                            ($order->payment_status == 1)
                                            ? __('Completed') . '✅'
                                            : __('Canceled') . '❌'
                                        }}

                                    </p>
                                    <p>{{__('Transaction ID')}} : [ {{@$order->transaction->transaction_id}} ]</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wsus__invoice_description">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>#</th>
                                    <th class="images">
                                        {{__('Image')}}
                                    </th>

                                    <th class="name">
                                        {{__('Product')}}
                                    </th>

                                    <th class="amount">
                                        {{__('Unit Price')}}
                                    </th>

                                    <th class="quentity">
                                        {{__('Quantity')}}
                                    </th>
                                    <th class="total">
                                        {{__('Total')}}
                                    </th>
                                </tr>
                                @foreach ($order->orderProducts as $unit)

                                    @php
                                        $variants = json_decode($unit->variants);
                                    @endphp
                                    <tr>
                                        <td>{{++$loop->index}}</td>

                                        <td class="images">
                                            <img src="{{ asset($unit->product->thumb_image) }}"
                                            alt="{{$unit->product_name}}" class="img-thumbnail img-fluid w-100">
                                        </td>

                                        <td class="name">
                                            <p class="fw-bold">{{$unit->product_name}}</p>
                                            @foreach ($variants as $key => $variant)
                                                <span>{{$key}} : {{$variant->name}}</span>
                                            @endforeach
                                        </td>
                                        <td class="amount">
                                            {{number_format($unit->unit_price) . ' ' . $settings->currency_icon}}
                                        </td>

                                        <td class="quentity">
                                            {{$unit->qty}}
                                        </td>
                                        <td class="total">
                                            {{number_format($unit->unit_price * $unit->qty) . ' ' . $settings->currency_icon}}
                                        </td>
                                    </tr>

                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>

                <div class="wsus__invoice_footer">
                    <p><span>{{__('Subtotal')}}:</span>
                        {{number_format($order->sub_total) . ' ' . $settings->currency_icon}}
                    </p>
                    @if ($coupon)
                        <p><span>{{__('Discount')}}: </span>
                            {{
                                ($coupon->discount_type === 'cash')
                                ? $coupon->discount . ' ' . $settings->currency_icon
                                : $coupon->discount . '%'
                            }}
                        </p>
                    @endif
                    <p><span>{{__('Shipping Cost')}}:</span>
                    {{
                        ($shipping->cost === 0)
                        ? __('Free')
                        : $shipping->cost . ' ' . $settings->currency_icon
                    }}</p>

                    <p><span>{{__('Total')}}:</span> {{number_format($order->amount) . ' ' . $settings->currency_icon}} </p>
                </div>

                <div class="mt-4 hide-print">
                    <div>
                        <button onclick="print()" class="mt-4 btn  btn-outline-primary print-btn">
                            <i class="fas fa-print"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



