<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name')
            ->orderBy('orders.id', 'desc')
            ->limit(10)
            ->get()
        ;
        $total_order = DB::table('orders')->count();
        $total_user = DB::table('users')->count();
        $total_product = DB::table('products')->count();
        $total_category = DB::table('categories')->count();
        $total_brand = DB::table('brands')->count();
        $total_order_pending = DB::table('orders')->where('status', '=', 0)->count();
        $total_order_shipping = DB::table('orders')->where('status', '=', 1)->count();
        $total_order_completed = DB::table('orders')->where('status', '=', 2)->count();
        $total_order_cancelled = DB::table('orders')->where('status', '=', 3)->count();
        $total_order_returned = DB::table('orders')->where('status', '=', 4)->count();
        $total_order_processing = DB::table('orders')->where('status', '=', 5)->count();
        //sản phẩm bán chạy nhất
            $best_seller = DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select('order_details.product_id', 'products.name', 'products.image_primary', 'products.price', DB::raw('SUM(order_details.quantity) as total_quantity'))
            ->groupBy('order_details.product_id', 'products.name', 'products.image_primary', 'products.price')
            ->orderBy('total_quantity', 'desc')
            ->limit(10)
            ->get();
        return view('be.dashboard.index',compact(
            'total_order',
            'total_user',
            'orders',
            'total_product',
            'total_category',
            'total_brand',
            'total_order_pending',
            'total_order_shipping',
            'total_order_completed',
            'total_order_cancelled',
            'total_order_returned',
            'total_order_processing',
            'best_seller'

        ));

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
