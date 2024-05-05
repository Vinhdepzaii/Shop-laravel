<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #007bff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        .cta-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>
<div class="container">
    <h1>Chào mừng bạn đến với Adara!</h1>
    <p>{{ $data['name'] }} Thân mến,</p>
    <p>Cảm ơn bạn đã mua hàng của chúng tôi. Chúng tôi rất vui khi có 1 khách hàng như bạn!</p>
    <p>Dưới đây là một số thông tin quan trọng dành cho bạn về đơn hàng:</p>
    <table>
        <tr>
            <th>Mã đơn hàng</th>
            <th>Tên khách hàng</th>
            <th>Địa chỉ</th>
            <th>Hình thức thanh toán</th>
            <th>Ngày đặt</th>
            <th>Tổng</th>
        </tr>
        <tr>
            <td>{{ $data['code'] }}</td>
            <td>{{ $data['name'] }}</td>
            <td>{{ $data['address'] }}</td>
            <td>{{ $data['payment'] }}</td>
            <td>{{ date('d-m-Y', strtotime($data['order_date'])) }}</td>
            <td>{{ number_format($data['total']) }} VNĐ</td>
        </tr>
    </table>
    <p>Chi tiết đơn hàng:</p>
    <table>
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Kích cỡ</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['cart'] as $key => $value)
                <tr>
                    <td>{{ $value['product_name'] }}</td>
                    <td>{{ number_format($value['product_price']) }} VNĐ</td>
                    <td>{{ $value['attribute'] }}</td>
                    <td>{{ $value['product_quantity'] }}</td>
                    <td>{{ number_format($value['product_price'] * $value['product_quantity']) }} VNĐ</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5" style="text-align: right">Tổng tiền:</td>
                <td>{{ number_format($data['total']) }} VNĐ</td>
            </tr>
        </tbody>
    </table>
    <p>Đơn hàng của bạn đang được xử lý và sẽ được giao trong thời gian sớm nhất.</p>


    <a href="{{ route('fe.home.index') }}" class="cta-button">Đến Adara</a>
</div>

<script>
    // Optional JavaScript code can be added here for interactivity
</script>
</body>

</html>
