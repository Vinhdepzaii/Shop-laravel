@extends('fe.layout.master')
@section('content')
    <section class="slider-area position-relative">
        <div class="third-slider-active">
            <div class="third-slider-item third-slider-bg" style="background: #0c85d0;height: 420px">
                <div class="container custom-container-two">
                    <div class="third-slider-wrap">

                        <div class="breadcrumb-content">
                            <h2 class="text-white">Trang thanh toán</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a class="text-white" href="{{ url('/') }}">Trang chủ</a></li>
                                    <li class="breadcrumb-item active text-white" aria-current="page">Thanh toán</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <a href="{{ route('fe.product.index') }}" style="margin-left: 315px;margin-top: 100px" class="btn bg-dark text-white  ">Tiếp tục mua hàng</a>
    @if(Session::has('cart') && count(session()->get('cart')) > 0)
        @php
            $total = 0;
            foreach (session()->get('cart') as $key => $value) {
                $total += $value['product_price'] * $value['product_quantity'];
            }
        @endphp
        <section class="checkout-area pt-95 pb-95">
            @if(!auth()->check())
                <form action="{{ route('client.order.store') }}" method="post">
                    @csrf
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="checkout-wrap">
                                    <div class="checkout-top">
                                        <h5 class="title">Chi tiết thanh toán</h5>
                                        <a href="{{ url('cart') }}" class="back"><i class="fas fa-angle-left"></i> -- Quay lại giỏ hàng</a>
                                    </div>
                                    <div class="checkout-form">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-grp">
                                                    <label for="name">Họ tên<span>*</span></label>
                                                    <input name="name" type="text" id="name" value="{{ old('name') }}" >
                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-grp">
                                                    <label for="email">Email<span>*</span></label>
                                                    <input type="email" id="email" value="{{ old('email') }}" name="email">
                                                    @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-grp">
                                                    <label for="phone">Số điện thoại<span>*</span></label>
                                                    <input type="text" id="phone" value="{{ old('phone') }}" name="phone">
                                                    @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-grp">
                                                    <label for="address">Địa chỉ<span>*</span></label>
                                                    <input type="text" id="address" value="{{ old('address') }}" name="address">
                                                    @error('address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-grp mb-0">
                                                    <label for="message">Ghi chú <small>( Không bắt buộc )</small></label>
                                                    <textarea name="note"  id="message" placeholder="Đóng gói sản phẩm zzzz">{{ old('note') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-8">
                                <aside class="checkout-sidebar">
                                    <h6 class="title">Tổng đơn hàng</h6>
                                    <div class="shop-cart-widget">
                                        <div>
                                            <ul>
                                                <li class="cart-total-amount mb-4"><span class="h4"> Tổng đơn hàng : </span> <span class="amount h4">{{ number_format($total, 0, ',', '.') }} VNĐ</span></li>
                                                <input type="hidden" value="{{ $total }}" name="total">
                                            </ul>
                                            <div class="payment-method-info">
                                                <input type="hidden" value="" name="payment_method">
                                                <div class="paypal-method-flex">
                                                    <div class="custom-control custom-checkbox">
                                                        <input  name="payment_method" type="checkbox" value="Thanh toán khi nhận hàng" class="custom-control-input" id="customCheck5" >
                                                        <label class="custom-control-label" for="customCheck5">Thanh toán khi nhận hàng</label>
                                                    </div>
                                                </div>


                                            </div>
                                            @error('payment_method')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <div class="payment-terms">
                                                <div class="custom-control custom-checkbox">
                                                    <input  type="checkbox" class="custom-control-input" id="customCheck7">
                                                    <label class="custom-control-label" for="customCheck7">Tôi đã đọc và đồng ý với điều khoản dịch vụ</label>
                                                </div>
                                            </div>
                                            <button class="btn mt-3 bg-dark text-white w-100">Đặt hàng</button>

                                        </div>
                                    </div>
                                </aside>
                            </div>
                        </div>
                    </div>
                </form>

            @else

                    <div class="container">
                        <form action="{{ route('client.order.store') }}" method="post" id="otherForm">
                            @csrf
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="checkout-wrap">
                                    <div class="checkout-top">
                                        <h5 class="title">Chi tiết thanh toán</h5>
                                        <a href="{{ url('cart') }}" class="back"><i class="fas fa-angle-left"></i> -- Quay lại giỏ hàng</a>
                                    </div>
                                    <div class="checkout-form">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-grp">
                                                    <label for="name">Họ tên<span>*</span></label>
                                                    <input name="name" type="text" id="name" value="{{ auth()->user()->name }}" >
                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-grp">
                                                    <label for="email">Email<span>*</span></label>
                                                    <input type="email" id="email" value="{{ auth()->user()->email }}" name="email">
                                                    @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-grp">
                                                    <label for="phone">Số điện thoại<span>*</span></label>
                                                    <input type="text" class="phone" id="phone" value="{{ auth()->user()->phone }}" name="phone">
                                                    @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-grp">
                                                    <label for="address">Địa chỉ<span>*</span></label>
                                                    <input type="text" id="address" class="address" value="{{ auth()->user()->address }}" name="address">
                                                    @error('address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-grp mb-0">
                                                    <label for="message">Ghi chú <small>( Không bắt buộc )</small></label>
                                                    <textarea name="note"  id="message" placeholder="Đóng gói sản phẩm zzzz">{{ old('note') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-8">
                                <aside class="checkout-sidebar">
                                    <h6 class="title">Tổng đơn hàng</h6>
                                    <div class="shop-cart-widget">
                                        <div>
                                            <ul>
                                                <li class="cart-total-amount mb-4"><span class="h4"> Tổng đơn hàng : </span> <span class="amount h4">{{ number_format($total, 0, ',', '.') }} VNĐ</span></li>
                                                <input type="hidden" value="{{ $total }}" name="total">
                                            </ul>
                                            <div class="payment-method-info">
                                                <input type="hidden" value="" name="payment_method">
                                                <div class="paypal-method-flex">
                                                    <div class="custom-control custom-checkbox">
                                                        <input  name="payment_method" type="checkbox" value="Thanh toán khi nhận hàng" class="custom-control-input" id="customCheck5" >
                                                        <label class="custom-control-label" for="customCheck5">Thanh toán khi nhận hàng</label>
                                                    </div>
                                                    <br>

                                                </div>
                                            </div>
                                            @error('payment_method')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            <button class="btn mt-3 bg-dark text-white w-100">Đặt hàng</button>
                                        </div>
                                    </div>
                                </aside>
                            </div>
                        </div>
                        </form>
                        <form action="{{ route('client.order.payment') }}" method="post" style="width: 450px" id="form-payment">
                            @php
                                $code = 'DH'.rand(100000,999999);
                            @endphp
                            @csrf
                            <input type="hidden" name="phone1" class="phone-payment" >
                            <input type="hidden" name="address1" class="address-payment">
                            <input type="hidden" name="total" value="{{ $total }}">
                            <input type="hidden" name="order_code" value="{{ $code }}">
                            <button name="redirect"  class="btn bg-dark text-white" id="payment-vnp" type="submit" >Thanh toán VNPay</button>
                        </form>
                    </div>
            @endif
        </section>
    @else
        <h3 class="text-center mt-5">Giỏ hàng của bạn đang trống !</h3>
    @endif
@endsection


