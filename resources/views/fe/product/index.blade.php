@extends('fe.layout.master')
@section('content')
    <section class="slider-area position-relative">
        <div class="third-slider-active">
            <div class="third-slider-item third-slider-bg" style="background: #37caff">
                <div class="container custom-container-two">
                    <div class="third-slider-wrap">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="slider-content">
                                    <h3 class="sub-title" data-animation-in="fadeInUp" data-delay-in=".2" data-duration-in="1.5">best offer !</h3>
                                    <a href="#" class="btn" data-animation-in="fadeInUp" data-delay-in=".8" data-duration-in="1.5">Mua ngay</a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="third-slider-img">
                                    <div class="img-shape" data-background="{{ asset('templates/fe/img/product/mwc.jpg') }}" data-animation-in="zoomIn"
                                         data-delay-in="1" data-duration-in="1.5"></div>
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
    <!-- shop-area -->
    <section class="shop-area pt-95 pb-100">
        <div class="container">
            <div class="shop-top-meta mb-35">
                <div class="row">
                    <div class="col-md-6">
                        <div class="shop-top-left">
                            <ul>
                                <li><a href="#"><i class="flaticon-menu"></i> Lọc</a></li>
                                <li>Hiển thị {{ $products->firstItem() }}-{{ $products->lastItem() }} của {{ $products->total() }} kết quả</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="shop-top-right">
                            <form class="form-filter">
                                <select name="filter" class="filter">
                                    <option value="">Sắp xếp theo mặc định</option>
                                    <option @if(isset($_GET['filter']) && $_GET['filter'] == 'price_desc')
                                                selected
                                            @endif value="price_desc">Sắp xếp theo giá giảm dần</option>
                                    <option @if(isset($_GET['filter']) && $_GET['filter'] == 'price_asc')
                                                selected
                                            @endif value="price_asc">Sắp xếp theo giá tăng dần</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                @if(count($products)>0)
                    @foreach($products as $product)
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="new-arrival-item text-center mb-50">
                                <div class="thumb mb-25">
                                    <a href="{{ route('fe.product.show',$product->slug) }}"><img style="width: 270px;height: 235px" src="{{ asset('uploads/'.$product->image_primary) }}" alt=""></a>
                                    <div class="product-overlay-action">
                                        <ul>
                                            <li><a href="cart.html"><i class="far fa-heart"></i></a></li>
                                            <li><a href="{{ route('fe.product.show',$product->slug) }}"><i class="far fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="content">
                                    <h5><a href="{{ route('fe.product.show',$product->slug) }}">{{ $product->name }}</a></h5>
                                    <span class="price">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @endif
            </div>
            @if(count($products)>0)
            <div class="pagination-wrap mt-30">
                <ul>
                    @if ($products->currentPage() > 1)
                        <li><a href="{{ $products->previousPageUrl() }}"><i class="fas fa-angle-left"></i></a></li>
                    @endif

                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                        <li class="{{ ($i === $products->currentPage()) ? 'active' : '' }}"><a href="{{ $products->url($i) }}">{{ $i }}</a></li>
                    @endfor

                    @if ($products->currentPage() < $products->lastPage())
                        <li><a href="{{ $products->nextPageUrl() }}"><i class="fas fa-angle-right"></i></a></li>
                    @endif
                </ul>
            </div>
            @else
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center h3">Không có sản phẩm nào!</div>
                    </div>
                </div>
            @endif

        </div>
    </section>
    <!-- shop-area-end -->
@endsection
