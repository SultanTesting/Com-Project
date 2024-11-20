@extends('admin.layouts.main')

@section('content')

    <section class="section">
        <div class="section-header">
        <h1>{{__('Invoice')}}</h1>
        <div class="breadcrumb section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">
                {{__('Dashboard')}}
            </a></div>
            <div class="breadcrumb-item"><a href="{{route('admin.order.index')}}">
                {{__('Manage Orders')}}
            </a></div>
            <div class="breadcrumb-item">{{__('Order')}}</div>
        </div>
        </div>

        <div class="section-body">
            <div class="invoice">
              <div class="invoice-print" id="printable">
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="invoice-title">
                        <h2>{{env('APP_NAME')}}</h2>
                        <span class="invoice-number">{{__('Order')}} #{{$order->invoice_id}}</span>
                        </div>
                        <hr>
                        <div class="row">
                        <div class="col-md-6">
                            <address>
                            <strong>{{__('Billed To')}}:</strong><br>
                                {{$address->name}}<br>
                                {{$address->email}}<br>
                                {{$address->address}}<br>
                                {{$address->phone}}<br>
                            </address>
                        </div>
                        <div
                            class="col-md-6 {{(dirSelect() == 'rtl' ? 'text-md-left' : 'text-md-right')}}"
                            >
                            <address>
                            <strong>{{__('Shipped To')}}:</strong><br>
                            {{$address->name}}<br>
                            {{$address->address}}<br>
                            {{$address->zip_code}}<br>
                            {{$address->city}}, {{$address->country}}
                            </address>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                            <address>
                            <strong>{{__('Payment Details')}}:</strong><br>
                            <b>{{__('Method')}}</b> : {{strtoupper($order->payment_method)}}<br>
                            <b>{{__('Status')}}</b> : {{($order->payment_status == 1) ? __('Completed') : 'Pending'}}<br>
                            <b>{{__('ID')}}</b> : {{@$order->transaction->transaction_id}}
                            </address>
                        </div>
                        <div
                            class="col-md-6 {{(dirSelect() == 'rtl' ? 'text-md-left' : 'text-md-right')}}"
                            >
                            <address>
                            <strong>{{__('Order Date')}}:</strong><br>
                            {{date("d M, Y", strtotime($order->created_at))}}<br><br>
                            </address>
                        </div>
                        </div>
                    </div>
                    </div>

                    <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="section-title">{{__('Order Summary')}}</div>
                        <p class="section-lead">{{__('All items here cannot be deleted.')}}</p>
                        <div class="table-responsive">
                        <table class="table table-striped table-hover table-md">
                            <tr>
                            <th data-width="40">#</th>
                            <th>{{__('Item')}}</th>
                            <th>{{__('Vendor')}}</th>
                            <th class="text-center">{{__('Price')}}</th>
                            <th class="text-center">{{__('Variants')}}</th>
                            <th class="text-center">{{__('Variants Price')}}</th>
                            <th class="text-center">{{__('Quantity')}}</th>
                            <th class="text-right">{{__('Total')}}</th>
                            </tr>

                            @foreach ($order->orderProducts as $product)
                            @php
                                $variants = json_decode($product->variants);
                            @endphp

                            <tr>
                                <td>{{++$loop->index}}</td>
                                <td>
                                    @if (isset($product->product->slug))
                                        <a target="_blank" href="{{route('product-detail', $product->product->slug)}}">
                                            {{$product->product_name}}
                                        </a>
                                    @else
                                        {{$product->product_name}}
                                    @endif
                                </td>
                                <td>{{$product->vendor->name}}</td>
                                <td class="text-center">
                                    {{number_format($product->unit_price) . ' ' . $settings->currency_icon}}
                                </td>
                                <td class="text-center">
                                    @foreach ($variants as $key => $variant)
                                        <p><b>{{$key}}</b> : {{$variant->name}}</p>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    {{$product->variants_total . ' ' . $settings->currency_icon}}
                                </td>
                                <td class="text-center">
                                    {{$product->qty}}
                                </td>
                                <td class="text-right">
                                    <b>
                                        {{
                                        number_format(($product->unit_price + $product->variants_total) * $product->qty) . ' ' . $settings->currency_icon
                                        }}
                                    </b>
                                </td>
                            </tr>
                            @endforeach

                        </table>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-6">
                                <div class="section-title">{{__('Payment Method')}}</div>

                                <div class="images ms-3">
                                    <img src='{{ asset("backend/assets/img/$order->payment_method.png") }}' alt="{{$order->payment_method}}" width="120px">
                                </div>

                                <div class="col-4 mt-3 hide-print">
                                    <input type="radio" class="btn-check pay_toggle" name="payment_status" id="1" autocomplete="off" {{($order->payment_status == 1) ? 'checked' : ''}}>
                                    <label class="btn btn-outline-success" for="1">{{__('Completed')}}</label>

                                    <input type="radio" class="btn-check pay_toggle" name="payment_status" id="0" autocomplete="off" {{($order->payment_status == 0) ? 'checked' : ''}}>
                                    <label class="btn btn-outline-danger" for="0">{{__('Pending')}}</label>
                                </div>

                                <div class="section-title hide-print">{{__('Order Status')}}</div>
                                <div class='col-4 mt-3 hide-print'>
                                    <select name="order_status" data-id="{{$order->id}}" class="form-control orderStatus">
                                        @foreach (orderStatus()['admin_order_status'] as $key => $status)
                                            <option {{($order->order_status == $key) ? 'selected' : ''}}
                                            value="{{$key}}">{{$status['status']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div
                                class="col-lg-6 invoice-total {{(dirSelect() == 'rtl') ? 'text-left' : 'text-right'}}"
                            >
                                    <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">
                                        {{__('Subtotal')}}
                                    </div>
                                    <div class="invoice-detail-value">
                                        {{number_format($order->sub_total) . ' ' .$settings->currency_icon}}
                                    </div>
                                    </div>
                                    @if ($coupon)
                                        <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">{{__('Coupon')}}(-)</div>
                                        <div class="invoice-detail-value">
                                            {{
                                                ($coupon->discount_type == 'cash')
                                                ? @$coupon->discount . ' ' . $settings->currency_icon
                                                : @$coupon->discount . '%'
                                            }}

                                        </div>
                                        </div>
                                    @endif
                                    <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">{{__('Shipping Cost')}}(+)</div>
                                    <div class="invoice-detail-value">
                                        {{($shipping->cost == 0)
                                        ? __('Free')
                                        : $shipping->cost . ' ' . $settings->currency_icon}}
                                    </div>
                                    </div>
                                    <hr class="mt-2 mb-2">
                                    <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">{{__('Total')}}</div>
                                    <div class="invoice-detail-value invoice-detail-value-lg">
                                        {{number_format($order->amount) . ' ' .$settings->currency_icon}}
                                    </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    </div>
              </div>
              <hr>
              <div class="text-md-right">
                <div class="float-lg-left mb-lg-0 mb-3">
                  <button class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i> Process Payment</button>
                  <a href="{{route('admin.order.index')}}" class="btn btn-danger btn-icon icon-left">
                    <i class="fas fa-undo"></i>
                    {{__('Back')}}
                </a>
                </div>
                <button onclick="print()" class="btn btn-warning btn-icon icon-left print-btn">
                    <i class="fas fa-print"></i>
                    {{__('Print')}}
                </button>
              </div>
            </div>
          </div>

    </section>

@endsection

@push('scripts')

<script>
    $(document).ready(function() {
        $('.orderStatus').change(function()
        {
            let id = $(this).data('id');
            let status = $(this).val();

            $.ajax({
                method: 'GET',
                url: "{{route('admin.order-status')}}",
                data: {
                    id: id,
                    status: status
                },
                success: function(data)
                {
                    iziToast.success({
                        title: "{{__('Success')}}",
                        message: data.message
                    })
                },
                error: function(xhr, error)
                {
                    iziToast.error({
                        title: "{{__('Oops')}}",
                        message: "Something Wrong!"
                    });

                    console.error(error);

                }
            })
        })

        $('.pay_toggle').change(function()
        {
            let id = "{{$order->id}}";
            let status = $(this).attr('id');

            $.ajax({
                method: "GET",
                url: "{{route('admin.payment-status')}}",
                data: {
                    id: id,
                    status: status
                },
                success: function(data) {
                    iziToast.success({
                        title: "{{__('Success')}}",
                        message: data.message
                    });
                },
                error: function(xhr, error) {
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


