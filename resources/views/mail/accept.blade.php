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

{{--    xác nhận --}}
    <p>Đơn hàng của bạn đã được xác nhận và đang trong quá trình vận chuyển</p>
    <p>Chúng tôi sẽ thông báo cho bạn khi đơn hàng được giao thành công.</p>
    <p>Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi qua email: <a href="mailto:khanhpham29703@gmail.com"> </a> hoặc số điện thoại: <a href="tel:0123456789">0123456789</a>.</p>
    <p>Chúng tôi rất vui khi được phục vụ bạn!</p>
    <p>Trân trọng,</p>
    <p>Adara</p>
</div>

<script>
    // Optional JavaScript code can be added here for interactivity
</script>
</body>

</html>
