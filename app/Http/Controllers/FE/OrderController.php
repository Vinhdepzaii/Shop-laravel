<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use App\Jobs\SendMailJob;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index()
    {
        Session::put('previous_url', url()->current());
        return view('fe.checkout.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|numeric',
            'address' => 'required',
            'payment_method' => 'required',
        ],
            [
                'name.required' => 'Vui lòng nhập tên',
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Vui lòng nhập đúng định dạng email',
                'email.unique' => 'Email đã tồn tại',
                'phone.required' => 'Vui lòng nhập số điện thoại',
                'phone_number.numeric' => 'Vui lòng nhập đúng định dạng số điện thoại',
                'address.required' => 'Vui lòng nhập địa chỉ',
                'payment_method.required' => 'Vui lòng chọn phương thức thanh toán',
            ]);
        $order_code = 'DH'.rand(100000,999999);

        if(auth()->check()) {
            $user_id = auth()->user()->id;
            User::query()->where('id', $user_id)->update([
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
        }else {
            $request->validate([
                'email' => 'unique:users',
            ],
                [
                    'email.unique' => 'Email đã tồn tại',
                ]);
            User::query()->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt('123456'),
                'role_id' => 10,
                'status' => 'active', // 'active', 'inactive', 'pending
                'phone' => $request->phone,
                'address' => $request->address,
            ]);

            $user_id = User::query()->where('email', $request->email)->first()->id;
        }
        Order::query()->create([
            'code' => $order_code,
            'user_id' => $user_id,
            'status' => 0,
            'payment' => $request->payment_method,
            'note' => $request->note,
            'order_date' => date('Y-m-d H:i:s'),
            'total_price' => $request->total,
        ]);
        $order_id = Order::query()->where('code', $order_code)->first()->id;
        $cart = session()->get('cart');
        foreach ($cart as $key => $value) {
            $product_id = $value['product_id'];
            $quantity = $value['product_quantity'];
            $price = $value['product_price'];
            $attribute = $value['attribute'];
            OrderDetail::query()->create([
                'order_id' => $order_id,
                'product_id' => $product_id,
                'quantity' => $quantity,
                'price' => $price,
                'attribute' => $attribute,
            ]);
        }
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'note' => $request->note,
            'total' => $request->total,
            'code' => $order_code,
            'payment' => $request->payment_method,
            'order_date' => date('Y-m-d H:i:s'),
            'status' => 0,
            'cart' => $cart,
        ];
        $email = $request->email;
        SendMailJob::dispatch($email, $data)->delay(now()->addSeconds(5));
        session()->forget('cart');
        return redirect()->route('fe.home.index')->with('success', 'Đặt hàng thành công');



    }
    public function payment(Request $request) {
        if(\auth()->check()){
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = route('client.order.checkoutPayment');
            $vnp_TmnCode = "905X4WV2";//Mã website tại VNPAY
            $vnp_HashSecret = "QVYFCVWICJHACSNOJQLGPRQBAMLMIBKH"; //Chuỗi bí mật
            $vnp_TxnRef = $request->input('order_code'); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 'Thanh toán đơn hàng';//tên sản phẩm
            $vnp_OrderType = 'billpayment';
            //địa chỉ
            $vnp_Bill_Mobile = $request->input('phone1');
            $vnp_Bill_Address = $request->input('address1');
            $vnp_Amount = $request->input('total')  * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
                "vnp_Bill_Mobile" => $vnp_Bill_Mobile,
                "vnp_Bill_Address" => $vnp_Bill_Address,
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
        }else {
            return redirect()->route('login');
        }
    }
    public function checkoutPayment(Request $request) {
        if ($request->vnp_ResponseCode == '00' && $request->vnp_TransactionStatus == '00') {
            if(\auth()->check()) {
                $order_code = $request->vnp_TxnRef;
                $total = $request->vnp_Amount / 100;
                //update user
                User::query()->where('id', \auth()->user()->id)->update([
                    'phone' => $request->vnp_Bill_Mobile,
                    'address' => $request->vnp_Bill_Address,
                ]);
                Order::query()->create([
                    'code' => $order_code,
                    'user_id' => \auth()->user()->id,
                    'status' => 0,
                    'payment' => 'Thanh toán VNPAY',
                    'note' => '',
                    'order_date' => date('Y-m-d H:i:s'),
                    'total_price' => $total,
                ]);
                $order_id = Order::query()->where('code', $order_code)->first()->id;
                $cart = session()->get('cart');
                foreach ($cart as $key => $value) {
                    $product_id = $value['product_id'];
                    $quantity = $value['product_quantity'];
                    $price = $value['product_price'];
                    $attribute = $value['attribute'];
                    OrderDetail::query()->create([
                        'order_id' => $order_id,
                        'product_id' => $product_id,
                        'quantity' => $quantity,
                        'price' => $price,
                        'attribute' => $attribute,
                    ]);
                }
                $data = [
                    'name' => \auth()->user()->name,
                    'email' => \auth()->user()->email,
                    'phone' => $request->vnp_Bill_Mobile,
                    'address' => $request->vnp_Bill_Address,
                    'note' => '',
                    'total' => $total,
                    'code' => $order_code,
                    'payment' => 'Thanh toán VNPAY',
                    'order_date' => date('Y-m-d H:i:s'),
                    'status' => 0,
                    'cart' => $cart,
                ];
                $email = \auth()->user()->email;
                SendMailJob::dispatch($email, $data)->delay(now()->addSeconds(5));
                session()->forget('cart');
                return redirect()->route('fe.home.index')->with('success', 'Đặt hàng thành công');
            }else {
                return redirect()->route('login');
            }
        } else {
            return redirect()->route('fe.home.index')->with('error', 'Đặt hàng thất bại');
        }

    }
}