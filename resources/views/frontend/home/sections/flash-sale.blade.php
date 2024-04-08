<section id="wsus__flash_sell" class="wsus__flash_sell_2">
    <div class=" container">
        <div class="row">
            <div class="col-xl-12">
                <div class="offer_time" style="background: url({{asset('frontend/images/flash_sell_bg.jpg')}})">
                    @if ($flash_end->end_date > now())
                        <div class="wsus__flash_coundown">
                            <span class=" end_text">Flash Sale</span>
                            <div class="simply-countdown simply-countdown-one"></div>
                            <a class="common_btn" href="{{route('flash-sale')}}">
                                See More <i class="fas fa-caret-right"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="row flash_sell_slider">
            @foreach ($flashItems as $item)
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <div class="wsus__product_item">

                        <span class="wsus__new">
                            {{productLabel($item->product->product_type)}}
                        </span>

                        @if ($item->product->offer_price)
                            <span class="wsus__minus">
                               - {{discountPercent($item->product->price, $item->product->offer_price)}}%
                            </span>
                        @endif

                        <a class="wsus__pro_link" href="{{route('product-detail', $item->product->slug)}}">
                            <img src="{{ asset($item->product->thumb_image) }}" alt="product" class="img-fluid w-100 img_1" />
                            <img
                             src="
                             @if (isset($item->product->gallery[0]->images))
                                {{asset($item->product->gallery[0]->images)}}
                             @else
                                {{asset($item->product->thumb_image)}}
                             @endif
                             "
                             alt="product" class="img-fluid w-100 img_2" />
                        </a>

                        <ul class="wsus__single_pro_icon">
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                        class="far fa-eye"></i></a></li>
                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                            <li><a href="#"><i class="far fa-random"></i></a>
                        </ul>

                        <div class="wsus__product_details">
                            <a class="wsus__category" href="#">
                                {{$item->product->category->name}}
                            </a>

                            <p class="wsus__pro_rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(133 review)</span>
                            </p>

                            <a class="wsus__pro_name" href="{{route('product-detail', $item->product->slug)}}">{{$item->product->name}}</a>

                            @if (checkDiscount($item->product))
                                <p class="wsus__price">
                                    {{$item->product->offer_price}} {{$settings->currency_icon}} <del>{{$item->product->price}}{{$settings->currency_icon}}</del>
                                </p>
                            @else
                                <p class="wsus__price"> {{$item->product->price}} {{$settings->currency_icon}} </p>
                            @endif


                            <a class="add_cart" href="#">add to cart</a>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
</section>

@push('scripts')
    <script>
        /** Making CountDown Responsive */
        $(document).ready(function(){
            simplyCountdown('.simply-countdown-one', {
                year:   {{date('Y',  strtotime($flash_end->end_date))}},
                month:  {{date('m',  strtotime($flash_end->end_date))}},
                day:    {{date('d',  strtotime($flash_end->end_date))}},
                hours:  {{date('H',  strtotime($flash_end->end_date))}},
                minutes: {{date('i', strtotime($flash_end->end_date))}},
                seconds: {{date('s', strtotime($flash_end->end_date))}},
            });
        })
    </script>
@endpush
