@extends('be.layout.app')
@section('content')
    <div class="row">
        <div class="col">
            <div class="container-fluid">
{{--               thống kê--}}
                <div class="row">
                    <div class="col bg-green-light text-center text-white p-2 m-2">
                        <h5 class="text-white">Tổng đơn hàng</h5>
                        <strong>{{ $total_order> 0 ? $total_order : 0 }}</strong>
                    </div>
                    <div class="col text-center text-white p-2 m-2 bg-primary">
                        <h5 class="text-white">Tổng sản phẩm</h5>
                        <strong>{{ $total_product> 0 ? $total_product : 0 }}</strong>
                    </div>
                    <div class="col text-white text-center p-2 m-2 bg-purpal">
                        <h5 class="text-white">Tổng danh mục</h5>
                        <strong>{{ $total_category> 0 ? $total_category : 0 }}</strong>
                    </div><div class="col text-white p-2 m-2 bg-red text-center">
                        <h5 class="text-white">Tổng tương hiệu</h5>
                        <strong>{{ $total_brand> 0 ? $total_brand : 0 }}</strong>
                    </div>

                </div>

                <div class="row">
                    <div class="col bg-green-light text-center text-white p-2 m-2">
                        <h5 class="text-white">Tổng đơn hàng chờ xử lý</h5>
                        <strong>{{ $total_order_pending> 0 ? $total_order_pending : 0 }}</strong>
                    </div>
                    <div class="col bg-success text-center text-white p-2 m-2">
                        <h5 class="text-white">Tổng đơn hàng đã xác nhận</h5>
                        <strong>{{ $total_order_shipping> 0 ? $total_order_shipping : 0 }}</strong>
                    </div>
                    <div class="col bg-red text-center text-white p-2 m-2">
                        <h5 class="text-white">Tổng đơn hàng đã bị hủy</h5>
                        <strong>{{ $total_order_returned> 0 ? $total_order_returned : 0 }}</strong>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col">
                        <h3>Top sản phẩm bán chạy nhất</h3>
                    </div>
                    <table class="table-order">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên sản phẩm</th>
                            <th>Ảnh</th>
                            <th>Giá</th>
                            <th>Số lượng đã bán</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($best_seller as $key => $product)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $product->name }}</td>
                                <td>
                                    <img src="{{ asset(Storage::url($product->image_primary)) }}" alt="" width="50px">
                                </td>
                                <td>{{ number_format($product->price) }}đ</td>
                                <td>{{ $product->total_quantity }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row page-titles mx-0">
                    <h3>Top 10 đơn hàng mới nhất</h3>
                </div>
                <div class="row">
                    <div class="col">
                        <table class=" table-order">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Mã đơn hàng</th>
                                <th>Tên khách hàng</th>
                                <th>Phương thức thanh toán</th>
                                <th>Trạng thái</th>
                                <th>Ngày đặt hàng</th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($orders as $key => $order)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $order->code }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->payment }}</td>
                                    <td>
                                        @if ($order->status == 0)
                                            <span class="badge badge-warning">Đang chờ xử lý</span>
                                        @elseif ($order->status == 1)
                                            <span class="badge badge-primary">Đã xác nhận</span>
                                        @elseif ($order->status == 2)
                                            <span class="badge badge-info">Đang vận chuyển</span>
                                        @elseif ($order->status == 3)
                                            <span class="badge badge-success">Đã giao hàng</span>
                                        @elseif ($order->status == 4)
                                            <span class="badge badge-danger">Đã hủy</span>
                                        @endif
                                    </td>
                                    <td>{{ date('d-m-Y',strtotime($order->created_at)) }}</td>
                                    <td>
                                        @if($order->status == 0)
                                            <form action="{{ route('orders.accept',$order->id) }}" method="post" style="display: inline-block">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="1">
                                                <button class="btn btn-sm btn-success">Xác nhận</button>
                                            </form>
                                        @endif
                                        <a href="{{ route('orders.show',$order->id) }}" class="btn btn-sm btn-info">Xem</a>
                                        <a href="{{route('orders.printOrder',$order->id)}}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> In hóa đơn</a>
                                        <form action="{{ route('orders.update',$order->id) }}" method="post" style="display: inline-block">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" value="4" name="status">
                                            <button  class="btn btn-sm btn-danger">Hủy</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.table-order').DataTable();
        } );
    </script>
@endsection
