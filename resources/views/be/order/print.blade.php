<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<style>
    body {
        font-family: Arial, sans-serif;
    }
</style>
<body>
<div class="container">
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

    <p>Các mục hàng đã nhận:</p>


</div>
</body>

</html>
