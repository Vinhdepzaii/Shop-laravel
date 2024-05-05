<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\Controller;
use App\Jobs\SendMailAccept;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Mail;
use App\Mail\AcceptMail;
class OrderController extends Controller
{
    public function index()
    {
        $orders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name')
            ->orderBy('orders.id', 'desc')
            ->get();
        return view('be.order.index', compact('orders'));
    }
    public function show($id) {
        $order = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.*', 'orders.id as order_id')
            ->where('orders.id', '=', $id)
            ->first();
        $order_detail = DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select('order_details.*', 'products.name', 'products.image_primary', 'products.price')
            ->where('order_details.order_id', '=', $id)
            ->get();
        return view('be.order.show', compact('order', 'order_detail'));
    }
    public function print($id) {
        $dompdf = new Dompdf();
        $options = new Options();
        $options->set('defaultFont', 'Arial'); // Thiết lập phông mặc định
        $dompdf->setOptions($options);
        $order = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.*', 'orders.id as order_id')
            ->where('orders.id', '=', $id)
            ->first();
        $html = view('be.order.print', compact('order'))->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->stream('document.pdf');
    }
    public function update(Request $request, $id) {
        $order = Order::query()->findOrFail($id);
        $order->status = $request->status;
        $order->save();
        return redirect()->route('orders.index')->with('success', 'Cập nhật trạng thái đơn hàng thành công');
    }
    public function accept($id) {
        $order = Order::query()->findOrFail($id);
        $order->status = 1;
        $info = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.*', 'orders.id as order_id')
            ->where('orders.id', '=', $id)
            ->first();
        $order_detail = DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select('order_details.*', 'products.name', 'products.image_primary', 'products.price')
            ->where('order_details.order_id', '=', $id)
            ->get();

        $data = [
             'name' => $info->name,
            'code' => $info->code,
            'phone' => $info->phone,
            'address' => $info->address,
            'email' => $info->email,
            'payment' => $info->payment,
            'order_date' => $info->created_at,
            'total' => $info->total_price,
        ];
        $sendMail = SendMailAccept::dispatch($data)->delay(now()->addSeconds(5));
        if($sendMail){
            $order->save();
            return redirect()->route('orders.index')->with('success', 'Cập nhật trạng thái đơn hàng thành công');
        }else{
            dd('Lỗi');
        }

    }
    public function create() {
        return view('be.order.create');
    }
    public function store(Request $request){
        $request->validate([

        ]);
    }

}
