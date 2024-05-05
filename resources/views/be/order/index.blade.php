@extends('be.layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col">
                <h3>Quản lý đơn hàng</h3>
            </div>
            <div class="col">
                <a href="{{ route('orders.create') }}" class="btn btn-primary float-right">Tạo mới đơn hàng</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="  table-order">
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
                            <td>{{ $key + 1 }}</td>
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
                                    <span class="badge badge-success">Đã nhận hàng</span>
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
                                    <input type="hidden" name="status" value="4">
                                    <button class="btn btn-sm btn-danger">Hủy</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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
