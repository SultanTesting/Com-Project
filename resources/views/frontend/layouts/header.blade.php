<!--============================
        HEADER START
    ==============================-->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-2 col-md-1 d-lg-none">
                    <div class="wsus__mobile_menu_area">
                        <span class="wsus__mobile_menu_icon"><i class="fal fa-bars"></i></span>
                    </div>
                </div>
                <div class="col-xl-2 col-7 col-md-8 col-lg-2">
                    <div class="wsus_logo_area">
                        <a class="wsus__header_logo" href="{{route('home')}}">
                            <img src="{{ asset('frontend/images/main-site-logo.png') }}" alt="logo" class="img-fluid w-100">
                        </a>
                    </div>
                </div>
                <div class="col-xl-5 col-md-6 col-lg-4 d-none d-lg-block">
                    <div class="wsus__search">
                        <form>
                            <input type="text" placeholder="Search...">
                            <button type="submit"><i class="far fa-search"></i></button>
                        </form>
                    </div>
                </div>

                <div class="col-xl-5 col-3 col-md-3 col-lg-6">
                    <div class="wsus__call_icon_area">
                        <div class="wsus__call_area">
                            <div class="wsus__call">
                                <i class="fas fa-user-headset"></i>
                            </div>
                            <div class="wsus__call_text">
                                <p>ecommerce@gmail</p>
                                <p>+201119969679</p>
                            </div>
                        </div>

                        <ul class="navbar wsus__icon_area ">
                            @include('components.language-changer')
                            <li><a href="wishlist.html"><i class="fal fa-heart"></i><span>05</span></a></li>
                            <li><a href="compare.html"><i class="fal fa-random"></i><span>03</span></a></li>
                            <li><a class="wsus__cart_icon" href="#">
                                        <i class="fal fa-shopping-bag"></i>
                                        <span id="cart-counter">{{Cart::content()->count()}}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="wsus__mini_cart">
            <h4>shopping cart <span class="wsus_close_mini_cart"><i class="far fa-times"></i></span></h4>

            <ul class="mini-cart">
                @if (cart::count() > 0)
                    @foreach (Cart::content() as $cartItem)
                        <li>
                            <div class="wsus__cart_img">
                                <a href="{{route('product-detail', $cartItem->options->slug)}}">
                                    <img src="{{ asset($cartItem->options->image) }}" alt="{!!$cartItem->name!!}" class="img-fluid w-100"></a>
                                <a class="wsis__del_icon" href="{{route('cart-delete', $cartItem->rowId)}}">
                                    <i class="fas fa-minus-circle "></i>
                                </a>
                            </div>
                            <div class="wsus__cart_text">
                                <a class="wsus__cart_title"
                                href="{{route('product-detail', $cartItem->options->slug)}}">{!! $cartItem->name !!}</a>
                                <div class="d-flex justify-content-between">
                                    <code>{{number_format($cartItem->price).$settings->currency_icon}} </code>
                                    <div style="display: ruby">
                                        <i class="fas fa-times fa-xs"></i>
                                        <p id="{{$cartItem->rowId . 'qty'}}" class="text-secondary">{{$cartItem->qty}}</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @else
                    <div class="d-flex flex-row justify-content-center">
                        <img src="{{ asset('frontend/images/empty-cart.png') }}" alt="empty-cart">
                    </div>
                @endif

            </ul>

            <div class="mini-cart-actions {{(Cart::count() < 1) ? 'd-none' : ''}}">
                <h5>sub total
                <span class="mini-cart-subTotal">
                {{Cart::subTotal('0')}} {{$settings->currency_icon}}
                </span>
                </h5>

                <div class="wsus__minicart_btn_area">
                    <a class="common_btn" href="{{route('cart-details')}}">view cart</a>
                    <a class="common_btn" href="{{route('user.checkout')}}">checkout</a>
                </div>
            </div>

        </div>



    </header>
    <!--============================
        HEADER END
    ==============================-->
