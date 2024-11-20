@section('title', "$settings->site_name || Checkout")

@extends('frontend.layouts.main')

@section('content')
<!--============================
        BREADCRUMB START
    ==============================-->
<section id="wsus__breadcrumb">
    <div class="wsus_breadcrumb_overlay">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4>check out</h4>
                    <ul>
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><a href="{{route('cart-details')}}">Cart</a></li>
                        <li><a href="javascript:;">check out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--============================
        BREADCRUMB END
    ==============================-->


<!--============================
        CHECK OUT PAGE START
    ==============================-->
<section id="wsus__cart_view">
    <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="wsus__check_form">
                        <h5>Billing Details</h5>
                        <div class="row">

                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body p-0">
                                        <div class="wsus__check_form p-0" style="box-shadow: none;">
                                            <div class="row">
                                                <div class="col-md-6 col-lg-12 col-xl-6">
                                                    <div class="wsus__check_single_form">
                                                        <input type="text" placeholder="First Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-12 col-xl-6">
                                                    <div class="wsus__check_single_form">
                                                        <input type="text" placeholder="Last Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-lg-12 col-xl-12">
                                                    <div class="wsus__check_single_form">
                                                        <input type="text"
                                                            placeholder="Company Name (Optional)">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-12 col-xl-6">
                                                    <div class="wsus__check_single_form">
                                                        <select class="select_2" name="state">
                                                            <option value="AL">Country / Region *</option>
                                                            <option value="">dhaka</option>
                                                            <option value="">barisal</option>
                                                            <option value="">khulna</option>
                                                            <option value="">rajshahi</option>
                                                            <option value="">bogura</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-12 col-xl-6">
                                                    <div class="wsus__check_single_form">
                                                        <input type="text" placeholder="Street Address *">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-12 col-xl-6">
                                                    <div class="wsus__check_single_form">
                                                        <input type="text"
                                                            placeholder="Apartment, suite, unit, etc. (optional)">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-12 col-xl-6">
                                                    <div class="wsus__check_single_form">
                                                        <input type="text" placeholder="Town / City *">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-12 col-xl-6">
                                                    <div class="wsus__check_single_form">
                                                        <input type="text" placeholder="State *">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-12 col-xl-6">
                                                    <div class="wsus__check_single_form">
                                                        <input type="text" placeholder="Zip *">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-12 col-xl-6">
                                                    <div class="wsus__check_single_form">
                                                        <input type="text" placeholder="Phone *">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-12 col-xl-6">
                                                    <div class="wsus__check_single_form">
                                                        <input type="email" placeholder="Email *">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion checkout_accordian" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                aria-expanded="false" aria-controls="collapseThree">
                                                <div class="wsus__check_single_form">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="flexCheckDefault" checked>
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Same as shipping address
                                                        </label>
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="wsus__check_single_form">
                                    <h5>Additional Information</h5>
                                    <textarea cols="3" rows="4" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                                </div>
                            </div>
                        </div>


                        <div class="d-flex justify-content-between mt-3">
                            <h5 class="">{{__('Shipping Address')}}</h5>
                            <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                {{__('Add New Address ?')}}
                            </a>
                        </div>

                        <div class="row">
                            @foreach ($addresses as $address)
                                <div class="col-xl-6">
                                    <div class="wsus__checkout_single_address">
                                        <div class="form-check">
                                            <input class="form-check-input shipping_address" type="radio" name="flexRadioDefault" id="flexRadioDefault1" data-id="{{$address->id}}"
                                            >
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Select Address
                                            </label>
                                        </div>
                                        <ul>
                                            <li><span>Name :</span>{{$address->name}}</li>
                                            <li><span>Phone :</span> {{$address->phone}}</li>
                                            <li><span>Email :</span> {{$address->email}}</li>
                                            <li><span>Country :</span> {{$address->country}}</li>
                                            <li><span>City :</span> {{$address->city}}</li>
                                            <li><span>Zip Code :</span> {{$address->zip_code}}</li>
                                            <li><span>Address :</span> {{$address->address}}</li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="wsus__order_details" id="sticky_sidebar">
                        <p class="wsus__product">shipping Methods</p>

                        @foreach ($shippingMethods as $shipMethod)
                            @if ($shipMethod->min_cost && $shipMethod->type === 'min_amount' && mainCartTotal() >= $shipMethod->min_cost)
                                <div class="form-check">
                                    <input class="form-check-input ship_method" type="radio" name="exampleRadios" id="exampleRadios1"
                                        value="{{$shipMethod->id}}" checked cost="0">
                                    <label class="form-check-label" for="exampleRadios1">
                                        Over 1000
                                        <span>(Free Shipping)</span>
                                    </label>
                                </div>
                            @elseif(!$shipMethod->min_cost && $shipMethod->type !== 'min_amount' && $shipMethod->cost > 0)
                                <div class="form-check">
                                    <input class="form-check-input ship_method" type="radio" name="exampleRadios" id="exampleRadios1"
                                        value="{{$shipMethod->id}}" cost="{{$shipMethod->cost}}">
                                    <label class="form-check-label" for="exampleRadios1">
                                        {{$shipMethod->name}}
                                        <span>({{$shipMethod->cost}} {{$settings->currency_icon}})</span>
                                    </label>
                                </div>
                            @endif
                        @endforeach
                        {{-- <div class="form-check">
                            <input class="form-check-input basic" type="radio" name="exampleRadios" id="exampleRadios1"
                                value="option1">
                            <label class="form-check-label" for="exampleRadios1">
                                free shipping
                                <span>(3 - 5 days)</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input express" type="radio" name="exampleRadios" id="exampleRadios2"
                                value="option2">
                            <label class="form-check-label" for="exampleRadios2">
                                express shipping
                                <span>(2 - 3 days)</span>
                            </label>
                        </div> --}}

                        <div class="wsus__order_details_summery">
                            <p>subtotal: <span>{{Cart::subtotal('0') . $settings->currency_icon}} </span></p>
                            <p>Discount: <span>{{getCartDiscount()}}</span></p>
                            <p>shipping fee:
                                <span class="shipping_fee">
                                    {{(mainCartTotal() >= $shipMethod->min_cost) ? 'Free' : 'Choose'}}
                                </span>
                            </p>
                            <p><b>total:</b> <span><b class="cartTotal">{{mainCartTotal() . $settings->currency_icon}}</b></span></p>
                        </div>

                        <div class="terms_area">
                            <div class="form-check">
                                <input class="form-check-input website_terms" type="checkbox" value=""
                                    id="flexCheckChecked3">
                                <label class="form-check-label" for="flexCheckChecked3">
                                    I have read and agree to the website <a href="#">terms and conditions *</a>
                                </label>
                            </div>
                        </div>

                        <form action="" class="checkout_form">
                            @csrf
                            <input type="hidden" name="shipping_address_id" class="shipping_address_id" value="">
                            <input type="hidden" name="shipping_method_id" class="shipping_method_id" value="">
                        </form>

                        <a href="" id="checkout_form" class="common_btn">Place Order</a>
                    </div>
                </div>
            </div>
    </div>
</section>

<div class="wsus__popup_address">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">add new address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="wsus__check_form p-3">
                        <form action="{{route('user.address.store')}}" method="POST">
                        @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="wsus__check_single_form">
                                        <input type="text" placeholder="Name" name="name"
                                        value="{{old('name')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wsus__check_single_form">
                                        <input type="text" placeholder="Phone *" name="phone"
                                        value="{{old('phone')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wsus__check_single_form">
                                        <input type="email" placeholder="Email *" name="email"
                                        value="{{old('email')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wsus__check_single_form">
                                        <select class="select_2" name="country">
                                            <option disabled selected>Country / Region *</option>
                                            @foreach (config('settings.country_list') as $country)
                                                <option {{($country === old('country')) ? 'selected' : ''}}
                                                value="{{$country}}">{{$country}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wsus__check_single_form">
                                        <input type="text" placeholder="Town / City *" name="city"
                                        value="{{old('city')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wsus__check_single_form">
                                        <input type="text" placeholder="State *" name="state"
                                        value="{{old('state')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wsus__check_single_form">
                                        <input type="text" placeholder="Zip *" name="zip_code"
                                        value="{{old('zip_code')}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="wsus__check_single_form">
                                        <input type="text" placeholder="Full Address *" name="address"
                                        value="{{old('address')}}">
                                    </div>
                                </div>

                                <input type="hidden" name="default" value="no">
                                <div class="col-xl-12">
                                    <div class="wsus__check_single_form">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--============================
        CHECK OUT PAGE END
    ==============================-->
@endsection

@push('scripts')
    <script>
        var currency = @json($settings->currency_icon);
        var cartTotal = @json((int)mainCartTotal());
        var formatter = Intl.NumberFormat('en-US');
    </script>

    <script>
        $(document).ready(function() {
            $('.ship_method').click(function(){
                let cost = Number($(this).attr('cost'));

                $('.shipping_fee').text(cost + currency);
                $('.cartTotal').text(formatter.format(cost + cartTotal) + currency);
                $('.shipping_method_id').val($(this).val());
            })

            $('.shipping_address').click(function() {
                $('.shipping_address_id').val($(this).data('id'));
            })

            setInterval(() => {
                let checked_method_cost = $('.ship_method:checked').attr('cost');

                if(checked_method_cost == 0)
                {
                    $('.shipping_method_id').val(20);
                }

            }, 1000);

            /** Submit Check-Out Form **/

            $('#checkout_form').click(function(e) {
                e.preventDefault();

                if($('.shipping_method_id').val() == "")
                {
                    iziToast.error({
                        'title': 'Oops, ',
                        'message': 'Shipping Method Required !'
                    });
                    return false;

                }else if ($('.shipping_address_id').val() == "")
                {
                    iziToast.error({
                        'title': 'Oops, ',
                        'message': 'Shipping Address Required !'
                    });
                    return false;

                }else if (!$('.website_terms').is(':checked')) {
                    iziToast.warning({
                        'title': 'Oops,',
                        'message': 'You Have To Accept Terms & Conditions !'
                    });
                    return false;

                }else {

                    let data = $('.checkout_form').serialize();

                    $.ajax({
                        method: "POST",
                        url: "{{route('user.checkout.submit')}}",
                        data: data,
                        beforeSend: function()
                        {
                            $('#checkout_form').html('<i class="fas fa-spinner fa-spin fa-1x"></i>');
                        },
                        success: function(data)
                        {
                            iziToast.success({
                                'title': 'Success',
                                'message': data.message
                            });

                            $('#checkout_form').html('<i class="fas fa-check-circle fa-lg"></i>');

                            window.location.href = data.redirect_url;
                        },
                        error: function(data)
                        {
                            console.log(data.responseText);
                        }
                    })
                }

            })
        })
    </script>
@endpush
