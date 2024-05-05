@extends('fe.layout.master')

@section('content')
    <section class="slider-area position-relative">
        <div class="third-slider-active">
            <div class="third-slider-item third-slider-bg" style="background: #0c85d0;height: 420px">
                <div class="container custom-container-two">
                    <div class="third-slider-wrap">

                        <h3 class="text-center text-white mt-2">Giỏ hàng</h3>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <a href="{{ route('fe.product.index') }}" style="margin-left: 315px;margin-top: 100px" class="btn bg-dark text-white  ">Tiếp tục mua hàng</a>
    <div class="cart-area pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cart-wrapper">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                <tr>
                                    <th class="product-thumbnail"></th>
                                    <th class="product-name">Tên sản phẩm</th>
                                    <th class="product-price">Giá</th>
                                    <th class="product-quantity">Số lượng</th>
                                    <th class="product-attribute">Kích thước</th>
                                    <th class="product-subtotal">Tổng tiền</th>
                                    <th class="product-delete"></th>
                                </tr>
                                </thead>
                                @php
                                    $total = 0;
                                @endphp
                                @if(Session::has('cart') && count(session()->get('cart')) > 0)
                                    <tbody class="tbody-cart">
                                    @foreach(session()->get('cart') as $key => $value)
                                        @php
                                            $total += $value['product_price'] * $value['product_quantity'];
                                        @endphp
                                        <tr data-id="{{ $value['key'] }}">

                                            <td class="product-thumbnail"><a href="{{ route('fe.product.show',$value['product_id']) }}"><img src="{{ asset(('uploads/'.$value['product_image'])) }}" alt=""></a></td>
                                            <td class="product-name">
                                                <h4><a href="{{ route('fe.product.show',$value['product_id']) }}">{{ $value['product_name'] }}</a></h4>
                                            </td>
                                            <td class="product-price">{{ number_format($value['product_price'], 0, ',', '.') }} </td>
                                            <td class="product-quantity">
                                                <div class="cart-plus-minus">
                                                    <form action="#" class="num-block">
                                                        <input  type="text" class="in-num update-cart product_quantity" value="{{ $value['product_quantity'] }}" readonly="">
                                                        <div class="qtybutton-box">
                                                            <span class="plus"><img src="{{ asset('templates/fe/img/icon/plus.png') }}" alt=""></span>
                                                            <span class="minus dis"><img src="{{ asset('templates/fe/img/icon/minus.png') }}" alt=""></span>
                                                        </div>
                                                    </form>
                                                </div>
                                            </td>
                                            <td>{{ $value['attribute'] }}</td>
                                            <td class="product-subtotal"><span>{{ number_format($value['product_price'] * $value['product_quantity'], 0, ',', '.') }} VNĐ</span></td>
                                            <td class="product-delete"><a href="{{ route('client.cart.deleteCartSession',$value['key']) }}"><i class="flaticon-trash"></i></a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                @else
                                    <tbody>
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <h3>Không có sản phẩm nào trong giỏ hàng</h3>
                                        </td>
                                    </tr>
                                    </tbody>
                                @endif
                            </table>
                        </div>

                    </div>
                    <div class="cart-total pt-95">
                        <h3 class="title">Tổng giỏ hàng</h3>
                        <div class="shop-cart-widget">
                            <form action="{{ route('client.order.payment') }}" method="post">
                                @php
                                    $code = 'DH'.rand(100000,999999);
                                @endphp
                                <input type="hidden" name="total" value="{{ $total }}">
                                <input type="hidden" name="order_code" value="{{ $code }}">
                                @csrf
                                <ul>
                                    <li class="cart-total-amount"><span>Tổng tiền</span> <span class="amount">{{ number_format($total, 0, ',', '.') }} VNĐ</span> </li>
                                </ul>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col pt-2"><a  href="{{ route('client.order.index') }}" class="btn mt-4">Thanh toán</a></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
