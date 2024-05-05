<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getProductBySlug(Request $request, string $slug)
    {
        if($request->filter) {
            $filter = $request->filter;
            if($filter == 'price_asc') {
                $products = Product::query()->orderBy('price', 'asc')->paginate(12);

            } else if($filter == 'price_desc') {
                $products = Product::query()->orderBy('price', 'desc')->paginate(12);
            } else if($filter == '') {
                $products = DB::table('products')
                    ->join('brands', 'products.brand_id', '=', 'brands.id')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->select('products.*', 'categories.name as category_name', 'brands.name as brand_name')
                    ->where('brands.slug', $slug)
                    ->paginate(8);
            }
        }else {
            $products = DB::table('products')
                ->join('brands', 'products.brand_id', '=', 'brands.id')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->select('products.*', 'categories.name as category_name', 'brands.name as brand_name')
                ->where('brands.slug', $slug)
                ->paginate(8);
        }
        $categories = Category::all();
        $brands = Brand::all();
        return view('fe.product.index', compact('products', 'categories', 'brands'));
    }
    public function index()
    {
        //
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
