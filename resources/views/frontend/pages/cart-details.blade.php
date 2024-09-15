@section('title', "$settings->site_name || Cart")

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
                        <h4>{{__('Cart')}}</h4>
                        <ul>
                            <li><a href="{{route('home')}}">{{__('Home')}}</a></li>
                            <li><a href="#">{{__('Cart')}}</a></li>
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
        CART VIEW PAGE START
    ==============================-->

    <section id="wsus__cart_view">
        <div class="container">
            @if (count($cart) < 1)
                <div class="d-flex justify-content-center">
                    <img src="{{ asset('frontend/images/shopping-empty.png') }}" alt="cart-is-empty">
                </div>
            @else
                <div class="row">
                    <div class="col-xl-9">
                        <div class="wsus__cart_list">
                            <div class="table-responsive">
                                <table>
                                    <tbody>
                                        <tr class="d-flex">
                                            <th class="wsus__pro_img">
                                                product
                                            </th>

                                            <th class="wsus__pro_name">
                                                product details
                                            </th>

                                            <th class="wsus__pro_select">
                                                Unit Price
                                            </th>

                                            <th class="wsus__pro_select " style="word-wrap: break-word">
                                                Options Price
                                            </th>

                                            <th class="wsus__pro_select">
                                                Total
                                            </th>

                                            <th class="wsus__pro_tk">
                                                Quantity
                                            </th>

                                            <th class="wsus__pro_icon">
                                                <a href="{{route('cart-clear-all')}}" class="common_btn delete-item">
                                                    clear cart
                                                </a>
                                            </th>
                                        </tr>

                                            @foreach ($cart as $cartItem)
                                                <tr class="d-flex">
                                                    <td class="wsus__pro_img"><img src="{{ asset($cartItem->options->image) }}" alt="{{$cartItem->name}}"
                                                            class="img-fluid w-100 img-thumbnail">
                                                    </td>

                                                    <td class="wsus__pro_name">
                                                        <p><b>{!! $cartItem->name !!}</b></p>
                                                        @foreach ($cartItem->options->variants as $key => $variant)
                                                            <span class="text-secondary">
                                                                {{$key}} : {{$variant['name']}} ({{$variant['price'].$settings->currency_icon}})
                                                            </span>
                                                        @endforeach
                                                    </td>

                                                    <td class="wsus__pro_tk">
                                                        <h6>{{number_format($cartItem->options->original_price) . $settings->currency_icon}}</h6>
                                                    </td>

                                                    <td class="wsus__pro_tk">
                                                        <h6>{{number_format($cartItem->options->variants_price) . $settings->currency_icon}}</h6>
                                                    </td>

                                                    <input class="{{$cartItem->rowId}}price" type="hidden" value="{{$cartItem->price}}">
                                                    <td class="wsus__pro_tk">
                                                        <code id="{{$cartItem->rowId}}">
                                                            {{number_format($cartItem->price * $cartItem->qty)}} {{$settings->currency_icon}}
                                                        </code>
                                                    </td>

                                                    <td class="wsus__pro_select">
                                                        <div class="select_number">
                                                            <input class="number_area qty" data-rowid="{{$cartItem->rowId}}" type="number" min="1" max="{{$cartItem->options->max}}" value="{{($cartItem->qty > $cartItem->options->max) ? $cartItem->options->max : $cartItem->qty}}" />
                                                        </div>
                                                    </td>

                                                    <td class="wsus__pro_icon">
                                                        <a href="{{route('cart-delete', $cartItem->rowId)}}">
                                                            <i class="far fa-times"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">

                        <div class="wsus__cart_list_footer_button" id="sticky_sidebar">
                            <h6>total cart</h6>
                            <p>subtotal:

                                <span id="subTotal">
                                    {{$subTotal}} {{$settings->currency_icon}}
                                </span></p>
                                <p>delivery:
                                    <code style="font-size: 18px">checkout page</code>
                                </p>
                                <p>discount:
                                    <code id="discount_cart" style="font-size: 18px">{{getCartDiscount()}}</code>
                                </p>
                                <p class="total"><span>total:</span>
                                    <span id="total_cart">
                                        {{mainCartTotal()}} {{$settings->currency_icon}}
                                    </span>
                                </p>

                                <form id="coupon_form">
                                    <input type="text" name="coupon_name" placeholder="Coupon Code"
                                    value="{{session()->has('coupon') ? session()->get('coupon')['coupon_code'] : ''}}">
                                    <button type="submit" class="common_btn">apply</button>
                                </form>

                                <a class="common_btn mt-4 w-100 text-center" href="{{route('user.checkout')}}">
                                    checkout
                                </a>
                                <a class="common_btn mt-1 w-100 text-center" href="{{route('home')}}">
                                    <i class="fab fa-shopify"></i>
                                    go shop
                                </a>
                        </div>


                    </div>
                </div>
            @endif
        </div>
    </section>
    {{-- <section id="wsus__single_banner">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content">
                        <div class="wsus__single_banner_img">
                            <img src="images/single_banner_2.jpg" alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>sell on <span>35% off</span></h6>
                            <h3>smart watch</h3>
                            <a class="shop_btn" href="#">shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content single_banner_2">
                        <div class="wsus__single_banner_img">
                            <img src="images/single_banner_3.jpg" alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>New Collection</h6>
                            <h3>Cosmetics</h3>
                            <a class="shop_btn" href="#">shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!--============================
          CART VIEW PAGE END
    ==============================-->
@endsection

@push('scripts')
    <script>
        var url = @json(route('cart.update-qty'));
        var subTotalUrl = @json(route('mini-cart.sub-total'));
        var cartCoupon =  @json(route('cart-coupon'));
        var couponCalcRoute = @json(route('cart.coupon-calc'));
        var currency = @json($settings->currency_icon);
        var subTotal = @json(Cart::priceTotal('0'));
    </script>

    <script src="{{ asset('frontend/js/cart-counter.js') }}"></script>

@endpush

