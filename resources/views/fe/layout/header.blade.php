<!-- header-area -->
<header class="header-style-two">
    <div id="sticky-header" class="main-header transparent-header menu-area">
        <div class="container custom-container-two">
            <div class="row">
                <div class="col-12">
                    <div class="mobile-nav-toggler"><i class="fas fa-bars"></i></div>
                    <div class="menu-wrap">
                        <nav class="menu-nav show">
                            <div class="logo">
                                <a href="{{ route('fe.home.index') }}" class="main-logo"><img src="{{ asset('templates/fe/img/logo/fw_logo.png') }}" alt="Logo"></a>
                                <a href="{{ route('fe.home.index') }}" class="sticky-logo"><img src="{{ asset('templates/fe/img/logo/logo.png') }}" alt="Logo"></a>
                            </div>
                            <div class="navbar-wrap main-menu d-none d-lg-flex">
                                <ul class="navigation">
                                    <li class="active menu-item-has-children has--mega--menu"><a href="{{ route('fe.home.index') }}">
                                            {{ __('Trang Chủ') }}
                                        </a></li>
                                    @php
                                        $categories_header = App\Http\Controllers\FE\CategoryController::getCategory();
                                        $brands_header = App\Http\Controllers\FE\CategoryController::getBrand();
                                    @endphp
                                    @if($categories_header)
                                        @foreach($categories_header as $category)
                                            <li class="active menu-item-has-children has--mega--menu"><a href="{{ route('fe.category.getProductBySlug',$category->slug) }}">{{ __($category->name) }}</a></li>
                                        @endforeach

                                        <li class="menu-item-has-children"><a href="{{ route('fe.product.index') }}"> {{ __('Sản Phẩm') }} </a>


                                            <ul class="submenu">

                                                @endif
                                                @if($brands_header)
                                                    @foreach($brands_header as $brand)
                                                        <li><a href="{{ route('fe.brand.getProductBySlug',$brand->slug) }}">{{ __($brand->name) }}</a></li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </li>

                                        <li><a href="#">{{ __('Liên Hệ') }}</a></li>
                                </ul>
                            </div>
                            <div class="header-action d-none d-md-block">
                                <ul>
                                    <li class="header-search"><a href="#" data-toggle="modal" data-target="#search-modal" id="btn-search" ><i class="flaticon-search"></i></a></li>
                                    @if(Session::has('cart') && count(Session::get('cart')) > 0)
                                        @php
                                            $count = 0;
                                            $total = 0;
                                        @endphp
                                        @foreach(session()->get('cart') as $key => $value)
                                            @php
                                                $count ++;
                                                $total += $value['product_price'] * $value['product_quantity'];
                                            @endphp
                                        @endforeach
                                    @else
                                        @php
                                            $count = 0;
                                            $total = 0;
                                        @endphp
                                    @endif
                                    <li class="header-shop-cart shop-cart"><a href="{{ route('client.cart.index') }}"><i class="flaticon-shopping-bag"></i><span class="count-cart">{{ $count }}</span></a>
                                        <ul class="minicart">

                                            @if(Session::has('cart') && count(Session::get('cart')) > 0)

                                                @foreach(session()->get('cart') as $key => $value)
                                                    @php
                                                        $count ++;
                                                    @endphp
                                                    <li class="d-flex align-items-start">
                                                        <div class="cart-img">
                                                            <a href="#"><img src="{{ asset(('uploads/'.$value['product_image'])) }}" alt=""></a>
                                                        </div>
                                                        <div class="cart-content">
                                                            <h4><a href="#">{{ $value['product_name'] }}</a></h4>
                                                            <div class="cart-price">
                                                                <span class="new">{{ number_format($value['product_price'], 0, ',', '.') }} VNĐ</span>
                                                            </div>

                                                            <div class="cart-qty">
                                                                <div class="product-qty">
                                                                    <span>Size: {{ $value['attribute'] }} - </span>
                                                                    <span>
                                                                    Số lượng : {{ $value['product_quantity'] }}
                                                                </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="del-icon">
                                                            <a href="{{ route('client.cart.deleteCartSession',$value['key']) }}"><i class="far fa-trash-alt"></i></a>
                                                        </div>

                                                    </li>

                                                @endforeach

                                                <li>
                                                    <div class="total-price">
                                                        <span class="f-left">{{ __('Tổng') }} :</span>
                                                        <span class="f-right">{{ number_format($total, 0, ',', '.') }} VNĐ</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="checkout-link">
                                                        <a href="{{ route('client.cart.index') }}">{{ __('Giỏ hàng') }}</a>
                                                        <a class="black-color" href="{{ route('client.order.index') }}">{{ __('Thanh toán') }}</a>
                                                    </div>
                                                </li>

                                            @else
                                                <h5>{{ __('Giỏ hàng trống !') }}</h5>
                                            @endif
                                        </ul>
                                    </li>

                                    <ul style="display: flex">
                                        <!-- Authentication Links -->
                                        @guest
                                            <li class="nav-item">
                                                <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Đăng Nhập') }}</a>
                                            </li>

                                        @endguest
                                        @auth
                                            <li class="nav-item dropdown">
                                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                    {{ Auth::user()->name }}
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                    <a href="" class="dropdown-item" >Hồ sơ</a>
                                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                        {{ __('Đăng xuất') }}
                                                    </a>

                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                          style="display: none;">
                                                        @csrf
                                                    </form>

                                                </div>
                                            </li>
                                        @endauth
                                    </ul>

                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            <i
                                                class="fas fa-globe-asia"
                                            ></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a href="{{ route('fe.language.index',['vi']) }}" class="dropdown-item" >{{ __('Tiếng Việt') }}</a>
                                            <a href="{{ route('fe.language.index',['en']) }}" class="dropdown-item" >{{ __('Tiếng Anh') }}</a>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </nav>
                    </div>

                    <!-- Mobile Menu  -->
                    <div class="mobile-menu">
                        <div class="close-btn"><i class="flaticon-targeting-cross"></i></div>
                        <nav class="menu-box">
                            <div class="nav-logo"><a href="{{ route('fe.home.index') }}"><img src="{{ asset('templates/fe/img/logo/logo.png') }}" alt="" title=""></a>
                            </div>
                            <div class="menu-outer">
                                <ul class="navigation">
                                    <li class="active menu-item-has-children"><a href="{{ route('fe.home.index') }}">Home</a></li>
                                    @if($categories_header)
                                        @foreach($categories_header as $category)
                                            <li ><a href="{{ route('fe.category.getProductBySlug',$category->slug) }}">{{ $category->name }}</a></li>
                                        @endforeach
                                    @endif
                                    <li class="menu-item-has-children"><a href="{{ route('fe.product.index') }}">Sản phẩm</a>
                                        <ul class="submenu">
                                            @if($brands_header)
                                                @foreach($brands_header as $brand)
                                                    <li><a href="{{ route('fe.brand.getProductBySlug',$brand->slug) }}">{{ $brand->name }}</a></li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </li>
                                    <li><a href="#">About Us</a></li>
                                    <li class="menu-item-has-children"><a href="#">blog</a>
                                        <ul class="submenu">
                                            <li><a href="blog.html">Our Blog</a></li>
                                            <li><a href="blog-details.html">Blog Details</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="contact.html">Contact Us</a></li>
                                    <li><a href="{{ route('fe.auth.login') }}">Đăng nhập</a></li>
                                </ul>
                            </div>
{{--                  login          --}}

                        </nav>
                    </div>
                    <div class="menu-backdrop"></div>
                    <!-- End Mobile Menu -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Search -->
    <div class="modal fade" id="search-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form >
                    <input type="text" placeholder="Search here..." id="search">
                    <button><i class="flaticon-search"></i></button>
                </form>
                <ul id="search-results" class="mt-5" style="height: 400px"></ul>
            </div>
        </div>
    </div>
    <!-- Modal Search-end -->

    <!-- off-canvas-start -->
    <div class="sidebar-toggle-btn"><a href="#" class="navSidebar-button"><img src="{{ asset('templates/fe/img/icon/sidebar_toggle_icon.png') }}" alt=""></a></div>
    <div class="sidebar-off-canvas info-group">
        <div class="off-canvas-overlay"></div>
        <div class="off-canvas-widget scroll">
            <div class="sidebar-widget-container">
                <div class="off-canvas-heading">
                    <a href="#" class="close-side-widget">
                        <span class="flaticon-targeting-cross"></span>
                    </a>
                </div>
                <div class="sidebar-textwidget">
                    <div class="sidebar-info-contents">
                        <div class="content-inner">
                            <div class="logo mb-30">
                                <a href="{{ route('fe.home.index') }}"><img src="{{ asset('templates/fe/img/logo/logo.png') }}" alt=""></a>
                            </div>
                            <div class="content-box">
                                <p>WooCommerce and WordPress are both free, open source software reasons many ...</p>
                            </div>
                            <div class="contact-info">
                                <h4 class="title">CONTACT US</h4>
                                <ul>
                                    <li><span class="flaticon-phone-call"></span><a href="tel:123456789">+9 325 444 0000</a></li>
                                    <li><span class="flaticon-email"></span><a href="mailto:adara@info.com">adara@info.com</a></li>
                                    <li><span class="flaticon-place"></span>71 Park Lan Street 2355 NY</li>
                                </ul>
                            </div>
                            <div class="oc-newsletter">
                                <h4 class="title">NEWSLETTER</h4>
                                <p>Fill your email below to subscribe to my newsletter</p>
                                <form action="#">
                                    <input type="email" placeholder="Email...">
                                    <button class="btn">Subscribe</button>
                                </form>
                            </div>
                            <div class="oc-social">
                                <ul>
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a href="#"><i class="fab fa-google"></i></a></li>
                                </ul>
                            </div>
                            <div class="oc-bottom">
                                <div class="currency">
                                    <form action="#">
                                        <label>Currency</label>
                                        <select name="select">
                                            <option value="">USD</option>
                                            <option value="">AUE</option>
                                            <option value="">SAR</option>
                                            <option value="">INR</option>
                                            <option value="">BDT</option>
                                        </select>
                                    </form>
                                </div>
                                <div class="language">
                                    <form action="#">
                                        <label>Language</label>
                                        <select name="select">
                                            <option value="">English</option>
                                            <option value="">Spanish</option>
                                            <option value="">Turkish</option>
                                            <option value="">Russian</option>
                                            <option value="">Chinese</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- off-canvas-end -->

</header>
<!-- header-area-end -->
