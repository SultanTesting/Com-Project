@section('title', "$settings->site_name || Vendor Orders")

@extends('vendor.layouts.main')

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
                                    @if ($unit->vendor_id === auth()->user()->vendor->id)
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
                                    @endif
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>

                <div class="wsus__invoice_footer justify-content-end">
                    <p>
                        <span>{{__('Total')}}:</span>
                        <b>{{number_format($total) . ' ' . $settings->currency_icon}}</b>
                    </p>
                </div>

                <div class="mt-4 d-flex justify-content-between hide-print">
                    <div>
                        <span>{{__('Order Status')}} : </span>
                        <div>
                            <input type="radio" class="btn-check status-toggle" name="options-outlined" id="success-outlined" data-id="{{$order->id}}" value="shipped" autocomplete="off"
                            {{($orderProducts->vendor_order_status === 'shipped') ? 'checked' : ''}}>
                            <label label class="btn btn-outline-success" for="success-outlined">
                                <i class="fas fa-shipping-fast"></i>
                            </label>
                            <input type="radio" class="btn-check status-toggle" name="options-outlined" id="danger-outlined" data-id="{{$order->id}}" value="canceled" autocomplete="off"
                            {{($orderProducts->vendor_order_status === 'canceled') ? 'checked' : ''}}>
                            <label class="btn btn-outline-danger" for="danger-outlined">
                                <i class="fas fa-ban"></i>
                            </label>
                        </div>
                    </div>
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

@push('scripts')

    <script>
        $(document).ready(function() {

            $('.status-toggle').change(function()
            {
                let orderId = $(this).data('id');
                let status = $(this).val();

                $.ajax({
                    method: "GET",
                    url: "{{route('vendor.orders.status')}}",
                    data: {
                        id: orderId,
                        status: status
                    },
                    success: function(data)
                    {
                        iziToast.success({
                            title: "{{__('Success')}}",
                            message: data.message
                        });
                    },
                    error: function(xhr, error)
                    {
                        iziToast.error({
                        title: "{{__('Oops')}}",
                        message: "Something Wrong !"
                        });

                        console.error(error);
                    }
                });

            })

        })
    </script>
@endpush
