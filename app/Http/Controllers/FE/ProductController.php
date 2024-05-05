<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Comment;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        if($request->filter) {
            $filter = $request->filter;
            if($filter == 'price_asc') {
                $products = Product::query()->orderBy('price', 'asc')->paginate(8);

            } else if($filter == 'price_desc') {
                $products = Product::query()->orderBy('price', 'desc')->paginate(8);
            } else if($filter == '') {
                $products = Product::query()->paginate(12);
            } else {
                $products = Product::query()->where('brand_id', '=', $filter)->paginate(8);
            }
        } else {
            $products = Product::query()->paginate(8);
        }
        return view('fe.product.index', compact('products'));
    }
    public function show(Request $request, string $slug)
    {
        Session::put('previous_url', url()->current());
        $product = Product::where('slug', $slug)->firstOrFail();
        $product_id = $product->id;
        $product_images = DB::table('image_products')->where('product_id', $product_id)->get();
        $categories = Category::all();
        $brands = Brand::all();
        $attributes = DB::table('attributes')->where('product_id', $product_id)->get();
        $alsoLike = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'categories.name as category_name', 'brands.name as brand_name','categories.slug as category_slug','brands.slug as brand_slug','products.slug as product_slug')
            ->where('products.category_id', $product->category_id)
            ->where('products.id', '!=', $product->id)
            ->inRandomOrder()
            ->limit(6)
            ->get();
        return view('fe.product.show', compact('product', 'categories', 'brands', 'product_images', 'attributes', 'alsoLike'));
    }
    public function getComments($id)
    {

        $comments = DB::table('comments')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->select('comments.*', 'users.name as user_name')
            ->where('product_id', $id)
            ->orderBy('comments.id', 'desc')
            ->get();
        $count = DB::table('comments')
            ->select('comments.*')
            ->where('product_id', $id)
            ->count();
        return response()->json(['comments' => $comments, 'count' => $count]);
    }
    public function storeComment(Request $request)
    {
        $request->validate([
            'message' => 'required',
        ], [
            'message.required' => 'Bạn chưa nhập nội dung bình luận!',
        ]);
        if(auth()->check()) {
            Comment::query()->create([
                'user_id' => auth()->user()->id,
                'product_id' => $request->product_id,
                'content' => $request->message,
            ]);
        }else {
            $urlLogin = route('fe.auth.login');
            return response()->json(['error' => 'Bạn cần đăng nhập để bình luận!', 'urlLogin' => $urlLogin , 'status' => 401]);
        }
        return response()->json(['success' => 'Gửi bình luận thành công!']);
    }

    public function search(Request $request) {
        $keyword = $request->search;
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'categories.name as category_name', 'brands.name as brand_name')
            ->where('products.name', 'like', '%'.$keyword.'%')
            ->orWhere('categories.name', 'like', '%'.$keyword.'%')
            ->orWhere('brands.name', 'like', '%'.$keyword.'%')
            ->get();
        return response()->json($products);
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
