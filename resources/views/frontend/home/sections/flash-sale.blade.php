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
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$item->product->id}}">
                                <i class="far fa-eye"></i></a></li>
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
                                    {{number_format($item->product->offer_price)}} {{$settings->currency_icon}} <del>{{number_format($item->product->price)}}{{$settings->currency_icon}}</del>
                                </p>
                            @else
                                <p class="wsus__price"> {{number_format($item->product->price)}} {{$settings->currency_icon}} </p>
                            @endif


                            <a class="add_cart" href="#">add to cart</a>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
</section>

<section class="product_popup_modal">
    @foreach ($flashItems as $item)
        <div class="modal fade" id="exampleModal-{{$item->product->id}}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                class="far fa-times"></i></button>
                        <div class="row">
                            <div class="col-xl-6 col-12 col-sm-10 col-md-8 col-lg-6 m-auto display">
                                <div class="wsus__quick_view_img">

                                    @if ($item->product->video_link)
                                        <a class="venobox wsus__pro_det_video" data-autoplay="true" data-vbtype="video"
                                        href="{{$item->product->video_link}}">
                                        <i class="fas fa-play"></i>
                                        </a>
                                    @endif

                                    <div class="row modal_slider">
                                        @if ($item->product->thumb_image)
                                            <div class="col-xl-12">
                                                <div class="modal_slider_img">
                                                    <img src="{{ asset($item->product->thumb_image) }}"
                                                    alt="{{$item->product->slug}}" class="img-fluid w-100">
                                                </div>
                                            </div>
                                        @endif

                                        @if (isset($item->product->gallery))
                                            @foreach ($item->product->gallery as $gallery)
                                                <div class="col-xl-12">
                                                    <div class="modal_slider_img">
                                                        <img class="img-fluid w-100"
                                                        src="{{ asset($gallery->images) }}"
                                                        alt="{{$item->product->slug}}" />
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-12 col-sm-12 col-md-12 col-lg-6">
                                <div class="wsus__pro_details_text">
                                    <a class="title" href="{{route('product-detail', $item->product->slug)}}">{{$item->product->name}}</a>
                                    <p class="wsus__stock_area"><span class="in_stock">in stock</span> ({{$item->product->quantity}} item)</p>
                                    @if (checkDiscount($item->product))
                                        <h4>
                                            {{number_format($item->product->offer_price)}} {{$settings->currency_icon}}
                                            <del>{{number_format($item->product->price)}} {{$settings->currency_icon}}</del>
                                        </h4>
                                    @else
                                            <h4>{{number_format($item->product->price)}} {{$settings->currency_icon}}</h4>
                                    @endif
                                    <p class="review">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <span>20 review</span>
                                    </p>
                                    <p class="description">{{$item->product->short_description}}</p>

                                    @if ($flash_end->end_date > now())
                                        <div class="wsus_pro_hot_deals">
                                            <h5>offer ending time : </h5>
                                            <div class="simply-countdown simply-countdown-one"></div>
                                        </div>
                                    @endif

                                    <form class="shopping-cart">

                                        @if ($item->product->quantity > 1)
                                        <div class="wsus__quentity">
                                                <h5>quantity : </h5>
                                                <div class="select_number">
                                                    <input name="qty" class="number_area" type="number" min="1" max="{{$item->product->quantity}}" value="1" />
                                                </div>
                                            </div>
                                        @endif

                                        <div class="wsus__selectbox">
                                            <div class="row">
                                                <input type="hidden" name="product_id" value="{{$item->product->id}}">
                                                @foreach ($item->product->variants as $variant)
                                                    <div class="col-xl-6 col-sm-6">
                                                        <h5 class="mb-2 mt-1">{{$variant->name}}:</h5>
                                                        <select class="select_2" name="variants[{{$variant->name}}]">
                                                            @foreach ($variant->items as $variantItem)
                                                                <option {{($variantItem->default == 'yes') ? 'selected' : ''}}
                                                                    value="{{$variantItem->id}}">
                                                                    {{$variantItem->name}} (+{{$variantItem->price}} {{$settings->currency_icon}})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <ul class="wsus__button_area">
                                            <li><button type="submit" class="add_cart" href="#">add to cart</button></li>
                                            <li><a class="buy_now" href="#">buy now</a></li>
                                            <li><a href="#"><i class="fal fa-heart"></i></a></li>
                                            <li><a href="#"><i class="far fa-random"></i></a></li>
                                        </ul>

                                    </form>

                                    <p class="brand_model"><span>brand : </span>
                                        <b>{{$item->product->brand->name}}</b>
                                    </p>

                                    <div class="wsus__pro_det_share">
                                        <h5>share :</h5>
                                        <ul class="d-flex">
                                            <li><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a class="whatsapp" href="#"><i class="fab fa-whatsapp"></i></a></li>
                                            <li><a class="instagram" href="#"><i class="fab fa-instagram"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
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

         {{-- Shopping Cart --}}
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.shopping-cart').on('submit', function(e)
        {
            e.preventDefault();

            let formData = $(this).serialize();

            $.ajax({
                method: "POST",
                data: formData,
                url: "{{route('add-to-cart')}}",
                success : function(data)
                {
                    console.log('Success');
                },
                error: function(xhr, status, error)
                {
                    console.error(error)
                }

            });
        })
        })
    </script>
@endpush
