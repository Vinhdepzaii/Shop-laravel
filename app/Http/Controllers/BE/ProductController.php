<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Response;
use App\Models\ImageProduct;
use App\Models\Attribute;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getProduct(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('category_id', function ($row) {
                    $category = Category::find($row->category_id);
                    return $category->name;
                })
                ->addColumn('brand_id', function ($row) {
                    $brand = Brand::find($row->brand_id);
                    return $brand->name;
                })
                ->addColumn('price', function ($row) {
                    $price = number_format($row->price, 0, ',', '.');
                    return $price . ' VNĐ';
                })
                ->addColumn('image', function ($row) {
                    $image = '<img src="' . asset('uploads/'.$row->image_primary) . '" width="100px" height="100px">';
                    return $image;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-flex">
                                <a href="/admin/edit-product/' . $row->id . '" class="btn btn-primary shadow btn-xs  sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                <a href="javascript:void(0);" data-id="' . $row->id . '" class="btn btn-danger shadow btn-xs sharp btn-delete"><i class="fa fa-trash"></i></a>
                                <a href="javascript:void(0);" data-id="' . $row->id . '" class="btn btn-primary sharp add-to-cart btn-xs mx-1"><i class="fa fa-shopping-cart" ></i></a>
                            </div>';
                    return $btn;
                })
                ->rawColumns(['action', 'image', 'category_id', 'brand_id', 'price'])
                ->make(true);
        }
    }

    public function generateProductCode()
    {
        $prefix = 'KH-';
        $randomCode = Str::random(8);
        $productCode = $prefix . $randomCode;
        while (self::codeExists($productCode)) {
            $randomCode = Str::random(8);
            $productCode = $prefix . $randomCode;
        }
        return $productCode;

    }

    private static function codeExists($productCode)
    {
        $product = Product::where('code', $productCode)->first();
        return $product !== null;
    }

    public function index()
    {
        return view('be.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $code_product = $this->generateProductCode();
        $brands = Brand::all();
        $categories = Category::all();
        return view('be.product.create', compact('code_product', 'brands', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function validateForm($request, $id = null)
    {
        $rules = [
            'name' => 'required|unique:products,name,' . $id,
            'image_primary' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'size_name' => 'required',
        ];
        $messages = [
            'name.required' => 'Tên sản phẩm không được để trống',
            'name.unique' => 'Tên sản phẩm đã tồn tại',
            'image_primary.required' => 'Ảnh sản phẩm không được để trống',
            'price.required' => 'Giá sản phẩm không được để trống',
            'category_id.required' => 'Danh mục sản phẩm không được để trống',
            'brand_id.required' => 'Thương hiệu sản phẩm không được để trống',
            'size_name.required' => 'Kích thước sản phẩm không được để trống',

        ];

        return $this->validate($request, $rules, $messages);
    }

    public function createSlug($slug)
    {
        $slug = Str::slug($slug);
        return $slug;
    }

    public function store(Request $request)
    {
        $this->validateForm($request);
        if ($request->hasFile('image_primary')) {
            $image_primary = $request->file('image_primary');
            $img_primary = Storage::put('images/products', $image_primary);
            $model = new Product();
            $model->fill($request->except(['slug', 'image_primary']));
            $model->slug = $this->createSlug($request->name);
            $model->image_primary = $img_primary;
            $model->save();
            $product_id = Product::query()->latest()->first()->id;
            if ($request->hasFile('images')) {
                $image_secondary = $request->file('images');
                foreach ($image_secondary as $image) {
                    $product_img = Storage::put('images/products', $image);
                    ImageProduct::query()->create([
                        'product_id' => $product_id,
                        'image' => $product_img,
                    ]);
                }
            }
            if ($request->has('size_name')) {
                $size_name = $request->size_name;
                foreach ($size_name as $size) {
                    Attribute::query()->create([
                        'product_id' => $product_id,
                        'size_name' => $size,
                        'quantity' => 100
                    ]);
                }
            }
            return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::query()->findOrFail($id);
        $product_images = ImageProduct::query()->where('product_id', $id)->get();
        $attributes = Attribute::query()->where('product_id', $id)->get();
        $brands = Brand::all();
        $categories = Category::all();
        return \response()->json([
            'product' => $product,
            'product_images' => $product_images,
            'attributes' => $attributes,
            'brands' => $brands,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::query()->findOrFail($id);
        $product_images = ImageProduct::query()->where('product_id', $id)->get();
        $attributes = Attribute::query()->where('product_id', $id)->get();
        $brands = Brand::all();
        $categories = Category::all();
        return view('be.product.edit', compact('product', 'brands', 'categories', 'product_images', 'attributes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::query()->findOrFail($id);
        $img_primary = "";
        if ($request->hasFile('image_primary')) {
            $image_primary = $request->file('image_primary');
            $img_primary = Storage::put('images/products', $image_primary);
            Storage::delete('images/products/' . $product->image_primary);
        } else {
            $img_primary = $request->image_primary_old;
        }
        $product->update($request->except(['slug', 'image_primary']));
        $product->slug = $this->createSlug($request->name);
        $product->image_primary = $img_primary;
        $product->save();
        $images = "";
        $images_product = ImageProduct::query()->where('product_id', $id)->get();
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images_product as $image_old) {
                $image_old->delete();
            }
            foreach ($images as $image) {
                $product_img = Storage::put('images/products', $image);
                ImageProduct::query()->create([
                    'product_id' => $id,
                    'image' => $product_img,
                ]);
            }
        } else {
            $images = $request->images_old;
        }

        $size_name_old = Attribute::query()->where('product_id', $id)->get();
        $size_name = $request->size_name;
        if ($request->has('size_name')) {
            foreach ($size_name_old as $size) {
                $size->delete();
            }
            foreach ($size_name as $size) {
                Attribute::query()->create([
                    'product_id' => $id,
                    'size_name' => $size,
                    'quantity' => 100
                ]);
            }
        }


        return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::query()->findOrFail($id);
        if($product->delete()){
            Storage::delete('images/products/' . $product->image_primary);
            $images = ImageProduct::query()->where('product_id', $id)->get();
            foreach ($images as $image) {
                Storage::delete('images/products/' . $image->image);
                $image->delete();
            }
            $size_name = Attribute::query()->where('product_id', $id)->get();
            foreach ($size_name as $size) {
                $size->delete();
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Xóa sản phẩm thành công'
        ]);
    }
}
