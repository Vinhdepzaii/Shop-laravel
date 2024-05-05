<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function saveCartSession(Request $request)
    {
        $request->validate([
            'attribute' => 'required',
            'product_quantity' => 'required|numeric|min:1',
        ],
            ['attribute.required' => 'Vui lòng chọn kích cỡ sản phẩm',
                'product_quantity.required' => 'Vui lòng nhập số lượng sản phẩm',
                'product_quantity.numeric' => 'Số lượng sản phẩm phải là số',
                'product_quantity.min' => 'Số lượng sản phẩm phải lớn hơn 0',
            ]
        );
        $product_id = $request->product_id;
        $product_quantity = $request->product_quantity;
        $attribute = $request->attribute;

        $product = Product::query()->find($product_id);

        if(!$request->session()->has('cart')) {
            $cart = [];
        }else {
            $cart = session()->get('cart');
        }
        $productKey = $product_id . '-' . $attribute;
        if(array_key_exists($productKey, $cart)) {
            $cart[$productKey]['product_quantity'] += $product_quantity;
        }else {
            $cart[$productKey] = [
                'key' => $productKey, // '1-1
                'product_id' => $product_id,
                'product_name' => $product->name,
                'product_image' => $product->image_primary,
                'product_price' => $product->price,
                'product_quantity' => $product_quantity,
                'attribute' => $attribute,
            ];
        }

        session()->put('cart', $cart);
        //unset session
//        Session::forget('cart');
        return back()->with('success', 'Thêm sản phẩm vào giỏ hàng thành công');
    }
    public function getCartSession()
    {
        if(session()->has('cart')) {
            $cart = session()->get('cart');
            return response()->json([
                'cart' => $cart,
            ]);
        }else {
            return response()->json([
                'cart' => [],
            ]);
        }
    }
    public function delCartbyKey($key) {
        $cart = session()->get('cart');
        unset($cart[$key]);
        session()->put('cart', $cart);
        return back()->with('success', 'Xóa sản phẩm khỏi giỏ hàng thành công');
    }
    public function delAllCart() {
        session()->forget('cart');
        return back()->with('success', 'Xóa tất cả sản phẩm khỏi giỏ hàng thành công');
    }
    public function index() {
        return view('fe.cart.index');
    }
    public function update(Request $request) {
        if($request->key && $request->product_quantity) {
            $cart = session()->get('cart');
            $cart[$request->key]['product_quantity'] = $request->product_quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cập nhật giỏ hàng thành công');
        }
    }
}
