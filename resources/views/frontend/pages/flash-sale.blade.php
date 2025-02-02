@section('title', "$settings->site_name || FlashSale")

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
                        <h4>Flash Sale</h4>
                        <ul>
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li><a href="#">Flash Sale</a></li>
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
        DAILY DEALS DETAILS START
    ==============================-->
    <section id="wsus__daily_deals">
        <div class="container">
            <div class="wsus__offer_details_area">
                {{-- Flash Sale Banner --}}
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <div class="wsus__offer_details_banner">
                            <img src="{{asset('frontend/images/offer_banner_2.png')}}" alt="offrt img" class="img-fluid w-100">
                            <div class="wsus__offer_details_banner_text">
                                <p>apple watch</p>
                                <span>up 50% 0ff</span>
                                <p>for all poduct</p>
                                <p><b>today only</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="wsus__offer_details_banner">
                            <img src="{{ asset('frontend/images/offer_banner_3.png') }}" alt="offrt img" class="img-fluid w-100">
                            <div class="wsus__offer_details_banner_text">
                                <p>xiaomi power bank</p>
                                <span>up 37% 0ff</span>
                                <p>for all poduct</p>
                                <p><b>today only</b></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="wsus__section_header rounded-0">
                            <h3>flash sell</h3>
                            <div class="wsus__offer_countdown">
                                <span class="end_text">ends time : </span>
                                <div class="simply-countdown simply-countdown-one"></div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Of Banner --}}

                <div class="row">

                    @foreach ($items as $item)
                        @if ($item->product->quantity >= 1)
                            <div class="col-xl-3">
                                <div class="wsus__offer_det_single">
                                    <div class="wsus__product_item">
                                        <a class="wsus__pro_link" href="{{route('product-detail', $item->product->slug)}}">
                                            <img src="{{asset($item->product->thumb_image)}}" alt="product" class="img-fluid w-100 img_1" />
                                            <img src="
                                                @if (isset($item->product->gallery[0]->images))
                                                    {{ asset($item->product->gallery[0]->images) }}
                                                @else
                                                    {{ asset($item->product->thumb_image) }}
                                                @endif
                                            " alt="product" class="img-fluid w-100 img_2" />
                                        </a>
                                        <div class="wsus__product_details">
                                            <a class="wsus__category" href=""> {{$item->product->category->name}} </a>
                                            <p class="wsus__pro_rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                                <span>(120 review)</span>
                                            </p>
                                            <a class="wsus__pro_name"
                                            href="{{route('product-detail', $item->product->slug)}}">{{$item->product->name}}
                                            </a>

                                            @if (checkDiscount($item->product))
                                                <p class="wsus__price">
                                                    {{number_format($item->product->offer_price)}} {{$settings->currency_icon}}
                                                    <del>{{number_format($item->product->price)}} {{$settings->currency_icon}}</del>
                                                </p>
                                            @else
                                                <p class="wsus__price"> {{number_format($item->product->price)}} {{$settings->currency_icon}} </p>
                                            @endif

                                            <form class="shopping-cart">
                                                <input type="hidden" name="product_id" value="{{$item->product->id}}">
                                                <input type="hidden" name="qty" value="1">
                                                @foreach ($item->product->variants->where('status', 'active') as $variant)
                                                    <select hidden name="variants[]">
                                                        @foreach ($variant->items->where('status', 'active') as $variantItem)
                                                            <option {{($variantItem->default == 'yes') ? 'selected' : ''}}
                                                                value="{{$variantItem->id}}">
                                                                {{$variantItem->name}} (+{{$variantItem->price}} {{$settings->currency_icon}})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @endforeach
                                                <button class="add_cart" href="#">add to cart</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="wsus__offer_progress">
                                        <p><span>Sold 100</span> <span>Total {{$item->product->quantity}}</span></p>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="20"
                                                aria-valuemin="0" aria-valuemax="100">65%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>

                <div id="pagination" class="mt-3">

                    {{$items->links()}}

                </div>

            </div>

        </div>
    </section>
    <!--============================
        DAILY DEALS DETAILS END
    ==============================-->
@endsection

@push('scripts')
    <script>
        /** Making CountDown Responsive */
        $(document).ready(function(){
            simplyCountdown('.simply-countdown-one', {
                year:   {{date('Y',  strtotime($flashTime->end_date))}},
                month:  {{date('m',  strtotime($flashTime->end_date))}},
                day:    {{date('d',  strtotime($flashTime->end_date))}},
                hours:  {{date('H',  strtotime($flashTime->end_date))}},
                minutes: {{date('i', strtotime($flashTime->end_date))}},
                seconds: {{date('s', strtotime($flashTime->end_date))}},
            });
        })
    </script>

    <script>
        var currency = @json($settings->currency_icon);
    </script>
@endpush
