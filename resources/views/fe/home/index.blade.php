@extends('fe.layout.master')
@section('content')
    <!-- slider-area -->
    <section class="slider-area position-relative">
        <div class="third-slider-active">
            <div class="third-slider-item third-slider-bg" data-background="{{ asset('templates/fe/img/slider/third_slider_bg.jpg') }}">
                <div class="container custom-container-two">
                    <div class="third-slider-wrap">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="slider-content">
                                    <h3 class="sub-title" data-animation-in="fadeInUp" data-delay-in=".2" data-duration-in="1.5">{{ __('ưu đãi tốt nhất !') }}</h3>
                                    <h2 class="title" data-animation-in="fadeInUp" data-delay-in=".4" data-duration-in="1.5"></h2>
                                    <a href="#" class="btn" data-animation-in="fadeInUp" data-delay-in=".8" data-duration-in="1.5">{{ __('Mua ngay') }}</a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="third-slider-img">
                                    <div class="img-shape" data-background="" data-animation-in="zoomIn"
                                         data-delay-in="1" data-duration-in="1.5"></div>
                                    <img src="{{ asset('templates/fe/img/slider/third_slider_img03.png') }}" alt="" class="main-img" data-animation-in="slideInRight2"
                                         data-delay-in="1" data-duration-in="1.5">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="third-slider-item third-slider-bg" data-background="{{ asset('templates/fe/img/slider/third_slider_bg.jpg') }}">
                <div class="container custom-container-two">
                    <div class="third-slider-wrap">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="slider-content">
                                    <h3 class="sub-title" data-animation-in="fadeInUp" data-delay-in=".2" data-duration-in="1.5">{{ __('Sản phẩm hàng đầu') }}</h3>
                                    <h2 class="title" data-animation-in="fadeInUp" data-delay-in=".4" data-duration-in="1.5">athletes shoes</h2>
                                    <p data-animation-in="fadeInUp" data-delay-in=".6" data-duration-in="1.5">Get up to 50% off Today Only</p>
                                    <a href="shop-sidebar.html" class="btn" data-animation-in="fadeInUp" data-delay-in=".8" data-duration-in="1.5">Shop now</a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="third-slider-img">
                                    <div class="img-shape" data-background="" data-animation-in="zoomIn"
                                         data-delay-in="1" data-duration-in="1.5"></div>
                                    <img src="{{ asset('templates/fe/img/slider/third_slider_img02.png') }}" alt="" class="main-img" data-animation-in="slideInRight2"
                                         data-delay-in="1" data-duration-in="1.5">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="third-slider-item third-slider-bg" data-background="{{ asset('templates/fe/img/slider/third_slider_bg.jpg') }}">
                <div class="container custom-container-two">
                    <div class="third-slider-wrap">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="slider-content">
                                    <h3 class="sub-title" data-animation-in="fadeInUp" data-delay-in=".2" data-duration-in="1.5">top deal !</h3>
                                    <h2 class="title" data-animation-in="fadeInUp" data-delay-in=".4" data-duration-in="1.5">New sports shoes</h2>
                                    <p data-animation-in="fadeInUp" data-delay-in=".6" data-duration-in="1.5">Get up to 50% off Today Only</p>
                                    <a href="shop-sidebar.html" class="btn" data-animation-in="fadeInUp" data-delay-in=".8" data-duration-in="1.5">Shop now</a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="third-slider-img">
                                    <div class="img-shape" data-background="" data-animation-in="zoomIn"
                                         data-delay-in="1" data-duration-in="1.5"></div>
                                    <img src="{{ asset('templates/fe/img/slider/third_slider_img03.png') }}" alt="" class="main-img" data-animation-in="slideInRight2"
                                         data-delay-in="1" data-duration-in="1.5">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="third-slider-item third-slider-bg" data-background="{{ asset('templates/fe/img/slider/third_slider_bg.jpg') }}">
                <div class="container custom-container-two">
                    <div class="third-slider-wrap">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="slider-content">
                                    <h3 class="sub-title" data-animation-in="fadeInUp" data-delay-in=".2" data-duration-in="1.5">best offer !</h3>
                                    <h2 class="title" data-animation-in="fadeInUp" data-delay-in=".4" data-duration-in="1.5">Gym sports shoes</h2>
                                    <p data-animation-in="fadeInUp" data-delay-in=".6" data-duration-in="1.5">Get up to 50% off Today Only</p>
                                    <a href="shop-sidebar.html" class="btn" data-animation-in="fadeInUp" data-delay-in=".8" data-duration-in="1.5">Shop now</a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="third-slider-img">
                                    <div class="img-shape" data-background="" data-animation-in="zoomIn"
                                         data-delay-in="1" data-duration-in="1.5"></div>
                                    <img src="{{ asset('templates/fe/img/slider/third_slider_img04.png') }}" alt="" class="main-img" data-animation-in="slideInRight2"
                                         data-delay-in="1" data-duration-in="1.5">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- slider-area-end -->

    <!-- shoes-category-area -->
    <div class="shoes-category-area pt-80 pb-30">
        <div class="container custom-container-two">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-9">
                    <div class="shoes-cat-item mb-50">
                        <div class="thumb mb-30">
                            <a href="shop-sidebar.html"><img src="{{ asset('templates/fe/img/images/shoes_cat_img01.jpg') }}" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-9">
                    <div class="shoes-cat-item mb-50">
                        <div class="thumb mb-30">
                            <a href="shop-sidebar.html"><img src="{{ asset('templates/fe/img/images/shoes_cat_img02.jpg') }}" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-9">
                    <div class="shoes-cat-item mb-50">
                        <div class="thumb mb-30">
                            <a href="shop-sidebar.html"><img src="{{ asset('templates/fe/img/images/shoes_cat_img03.jpg') }}" alt=""></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- shoes-category-area-end -->

    <!-- trending-product-area -->
    <section class="trending-product-area trending-product-two gray-bg pt-95 pb-100">
        <div class="container custom-container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-6">
                    <div class="section-title title-style-two text-center mb-50">
                        <h3 class="title">{{ __('Sản phẩm của chúng tôi') }}</h3>
                    </div>
                </div>
            </div>
            @php
                $brands = \App\Models\Brand::all()
            @endphp
            @if(count($brands)> 0)
                <div class="row no-gutters trending-product-grid">
                    <div class="col-2">
                        <div class="trending-products-list">
                            <h5>{{ __('Thương hiệu giày') }}</h5>

                            <ul class="nav nav-tabs" id="trendingTab" role="tablist">
                                @foreach($brands as $key=>$value)
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link {{ $key == 0 ? 'active' : '' }}" id="accessories-tab" data-toggle="tab" href="#tab{{ $value->id }}" role="tab" aria-controls="accessories" aria-selected="true">{{ __($value->name) }}</a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <div class="col-10">
                        <div class="tab-content tp-tab-content" id="trendingTabContent">
                            @foreach($brands as $key=>$value)
                                <div class="tab-pane {{ $key == 0 ? 'show active' : '' }}" id="tab{{ $value->id }}" role="tabpanel" aria-labelledby="accessories-tab">

                                    <div class="trending-products-banner banner-animation">
                                        <a href="shop-sidebar.html"><img src="{{ asset('templates/fe/img/images/trending_banner03.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="row trending-product-active">
                                        @php
                                            $products = \App\Models\Product::where('brand_id', $value->id)->get();
                                        @endphp
                                        @if(count($products) > 0)
                                            @foreach($products as $product)
                                                <div class="col" style="width: 360px;height: 470px">
                                                    <div class="features-product-item" style="height: 100%;">
                                                        <div class="features-product-thumb" style="height: 322px">
                                                            @if($product->sale_off > 0)
                                                                <div class="discount-tag">-{{ $product->sale_off }}%</div>
                                                            @else
                                                                <div class="discount-tag" style="background-color: #00c853">New</div>
                                                            @endif
                                                            <a href="{{ route('fe.product.show',$product->slug) }}">
                                                                <img style="width: 215px;height: 100%" src="{{ asset(('uploads/'.$product->image_primary)) }}" alt="">
                                                            </a>
                                                            <div class="product-overlay-action">
                                                                <ul>
                                                                    <li><a href=""><i class="far fa-heart"></i></a></li>
                                                                    <li><a href=""><i class="far fa-eye"></i></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="features-product-content" style="height: 150px">
                                                            <div class="rating">
                                                                <i class="far fa-star"></i>
                                                                <i class="far fa-star"></i>
                                                                <i class="far fa-star"></i>
                                                                <i class="far fa-star"></i>
                                                                <i class="far fa-star"></i>
                                                            </div>
                                                            <h5><a href="{{ route('fe.product.show',$product->slug) }}">{{ $product->name }}</a></h5>
                                                            @if($product->sale_off > 0)
                                                                <p class="price"><del>{{ number_format($product->price,0,',','.') }} VNĐ</del> {{ number_format($product->price - ($product->price * $product->sale_off / 100), 0, ',', '.') }} VNĐ</p>

                                                            @else
                                                                <p class="price">{{ number_format($product->price, 0, ',', '.') }} VNĐ</p>

                                                            @endif

                                                        </div>
                                                        <div class="features-product-cart"><a href="{{ route('fe.product.show',$product->slug) }}">Xem chi tiết</a></div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <h4 class="mt-5">{{ __('Không có sản phẩm nào') }}</h4>
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- trending-product-area-end -->

    <!-- new-arrival-area -->
    {{--    <section class="new-arrival-area pt-95 pb-45">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row justify-content-center">--}}
    {{--                <div class="col-xl-4 col-lg-6">--}}
    {{--                    <div class="section-title title-style-two text-center mb-45">--}}
    {{--                        <h3 class="title">New Arrival Collection</h3>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="row justify-content-center">--}}
    {{--                <div class="col-lg-6">--}}
    {{--                    <div class="new-arrival-nav mb-35">--}}
    {{--                        <button class="active" data-filter="*">Best Sellers</button>--}}
    {{--                        <button class="" data-filter=".cat-one">New Products</button>--}}
    {{--                        <button class="" data-filter=".cat-two">Sales Products</button>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="row new-arrival-active">--}}
    {{--                <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer cat-two">--}}
    {{--                    <div class="new-arrival-item text-center mb-50">--}}
    {{--                        <div class="thumb mb-25">--}}
    {{--                            <a href="shop-details.html"><img src="{{ asset('templates/fe/img/product/shoes_arrival_product01.jpg') }}" alt=""></a>--}}
    {{--                            <div class="product-overlay-action">--}}
    {{--                                <ul>--}}
    {{--                                    <li><a href="cart.html"><i class="far fa-heart"></i></a></li>--}}
    {{--                                    <li><a href="shop-details.html"><i class="far fa-eye"></i></a></li>--}}
    {{--                                </ul>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="content">--}}
    {{--                            <h5><a href="shop-details.html">Athletes Shoes</a></h5>--}}
    {{--                            <span class="price">$37.00</span>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer cat-one">--}}
    {{--                    <div class="new-arrival-item text-center mb-50">--}}
    {{--                        <div class="thumb mb-25">--}}
    {{--                            <div class="discount-tag">- 20%</div>--}}
    {{--                            <a href="shop-details.html"><img src="{{ asset('templates/fe/img/product/shoes_arrival_product02.jpg') }}" alt=""></a>--}}
    {{--                            <div class="product-overlay-action">--}}
    {{--                                <ul>--}}
    {{--                                    <li><a href="cart.html"><i class="far fa-heart"></i></a></li>--}}
    {{--                                    <li><a href="shop-details.html"><i class="far fa-eye"></i></a></li>--}}
    {{--                                </ul>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="content">--}}
    {{--                            <h5><a href="shop-details.html">Mountain Shoes</a></h5>--}}
    {{--                            <span class="price">$25.00</span>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer cat-two cat-one">--}}
    {{--                    <div class="new-arrival-item text-center mb-50">--}}
    {{--                        <div class="thumb mb-25">--}}
    {{--                            <a href="shop-details.html"><img src="{{ asset('templates/fe/img/product/shoes_arrival_product03.jpg') }}" alt=""></a>--}}
    {{--                            <div class="product-overlay-action">--}}
    {{--                                <ul>--}}
    {{--                                    <li><a href="cart.html"><i class="far fa-heart"></i></a></li>--}}
    {{--                                    <li><a href="shop-details.html"><i class="far fa-eye"></i></a></li>--}}
    {{--                                </ul>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="content">--}}
    {{--                            <h5><a href="shop-details.html">Travelling Shoes</a></h5>--}}
    {{--                            <span class="price">$19.50</span>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer cat-two">--}}
    {{--                    <div class="new-arrival-item text-center mb-50">--}}
    {{--                        <div class="thumb mb-25">--}}
    {{--                            <div class="discount-tag new">New</div>--}}
    {{--                            <a href="shop-details.html"><img src="{{ asset('templates/fe/img/product/shoes_arrival_product04.jpg') }}" alt=""></a>--}}
    {{--                            <div class="product-overlay-action">--}}
    {{--                                <ul>--}}
    {{--                                    <li><a href="cart.html"><i class="far fa-heart"></i></a></li>--}}
    {{--                                    <li><a href="shop-details.html"><i class="far fa-eye"></i></a></li>--}}
    {{--                                </ul>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="content">--}}
    {{--                            <h5><a href="shop-details.html">Women Shoes</a></h5>--}}
    {{--                            <span class="price">$12.90</span>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer cat-one">--}}
    {{--                    <div class="new-arrival-item text-center mb-50">--}}
    {{--                        <div class="thumb mb-25">--}}
    {{--                            <div class="discount-tag">- 20%</div>--}}
    {{--                            <a href="shop-details.html"><img src="{{ asset('templates/fe/img/product/shoes_arrival_product05.jpg') }}" alt=""></a>--}}
    {{--                            <div class="product-overlay-action">--}}
    {{--                                <ul>--}}
    {{--                                    <li><a href="cart.html"><i class="far fa-heart"></i></a></li>--}}
    {{--                                    <li><a href="shop-details.html"><i class="far fa-eye"></i></a></li>--}}
    {{--                                </ul>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="content">--}}
    {{--                            <h5><a href="shop-details.html">Men Shoes</a></h5>--}}
    {{--                            <span class="price">$49.90</span>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer cat-two cat-one">--}}
    {{--                    <div class="new-arrival-item text-center mb-50">--}}
    {{--                        <div class="thumb mb-25">--}}
    {{--                            <div class="discount-tag new">New</div>--}}
    {{--                            <a href="shop-details.html"><img src="{{ asset('templates/fe/img/product/shoes_arrival_product06.jpg') }}" alt=""></a>--}}
    {{--                            <div class="product-overlay-action">--}}
    {{--                                <ul>--}}
    {{--                                    <li><a href="cart.html"><i class="far fa-heart"></i></a></li>--}}
    {{--                                    <li><a href="shop-details.html"><i class="far fa-eye"></i></a></li>--}}
    {{--                                </ul>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="content">--}}
    {{--                            <h5><a href="shop-details.html">Fashion Shoes</a></h5>--}}
    {{--                            <span class="price">$31.99</span>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer cat-one">--}}
    {{--                    <div class="new-arrival-item text-center mb-50">--}}
    {{--                        <div class="thumb mb-25">--}}
    {{--                            <a href="shop-details.html"><img src="{{ asset('templates/fe/img/product/shoes_arrival_product07.jpg') }}" alt=""></a>--}}
    {{--                            <div class="product-overlay-action">--}}
    {{--                                <ul>--}}
    {{--                                    <li><a href="cart.html"><i class="far fa-heart"></i></a></li>--}}
    {{--                                    <li><a href="shop-details.html"><i class="far fa-eye"></i></a></li>--}}
    {{--                                </ul>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="content">--}}
    {{--                            <h5><a href="shop-details.html">New Shoes</a></h5>--}}
    {{--                            <span class="price">$19.99</span>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer cat-two">--}}
    {{--                    <div class="new-arrival-item text-center mb-50">--}}
    {{--                        <div class="thumb mb-25">--}}
    {{--                            <div class="discount-tag">- 45%</div>--}}
    {{--                            <a href="shop-details.html"><img src="{{ asset('templates/fe/img/product/shoes_arrival_product08.jpg') }}" alt=""></a>--}}
    {{--                            <div class="product-overlay-action">--}}
    {{--                                <ul>--}}
    {{--                                    <li><a href="cart.html"><i class="far fa-heart"></i></a></li>--}}
    {{--                                    <li><a href="shop-details.html"><i class="far fa-eye"></i></a></li>--}}
    {{--                                </ul>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="content">--}}
    {{--                            <h5><a href="shop-details.html">Travelling Bags</a></h5>--}}
    {{--                            <span class="price">$9.99</span>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}
    <!-- new-arrival-area-end -->


@endsection
