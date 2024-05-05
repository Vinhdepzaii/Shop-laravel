@extends('be.layout.app')
@section('content')

    <div class="container py-5">
        <a href="{{ route('orders.index') }}" class="btn mt-5 mb-5 btn-primary">Quay lại</a>
        <h3>Chi tiết đơn hàng</h3>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Người nhận:</strong> {{ $order->name }}</p>
                <p><strong>Địa chỉ giao hàng:</strong> {{ $order->address }}</p>
                <p><strong>Số điện thoại:</strong> {{ $order->phone }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Mã đơn hàng:</strong> {{ $order->code }}</p>
                <p><strong>Phương thức thanh toán:</strong> {{ $order->payment }}</p>
                <p>
                    <strong>Trạng thái đơn hàng :
                        @if($order->status == 0)
                            <span class="badge badge-warning">Đang chờ xử lý</span>
                        @elseif($order->status == 1)
                            <span class="badge badge-primary">Đã xác nhận</span>
                        @elseif($order->status == 2)
                            <span class="badge badge-info">Đang vận chuyển</span>
                        @elseif($order->status == 3)
                            <span class="badge badge-success">Đã giao hàng</span>
                        @elseif($order->status == 4)
                            <span class="badge badge-danger">Đã hủy</span>
                        @endif
                    </strong>
                </p>
            </div>
        </div>

        <hr>

        <p>Thông tin đơn hàng của bạn :</p>

        <table class="table table-responsive-tiny">
            <thead>
            <tr>
                <th>#</th>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Thành tiền</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order_detail as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        <img src="{{ asset('uploads/'.$value->image_primary) }}" alt="" width="80px">
                    </td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->quantity }}</td>
                    <td>{{ number_format($value->price) }} đ</td>
                    <td>{{ number_format($value->price * $value->quantity) }} đ</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5" class="text-right"><strong>Tổng tiền :</strong></td>
                <td><strong>{{ number_format($order->total_price) }} đ</strong></td>
            </tr>
            </tbody>
        </table>
    </div>

@endsection
