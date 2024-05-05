<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getBrand(Request $request)
    {
        if($request->ajax()) {
            $data = Brand::query()->orderByDesc('id')->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function($row) {
                    $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'"  class=" btn btn-danger btn-delete">Xóa</a>';
                    $btn .= '  <a href="javascript:void(0)" data-id="'.$row->id.'" class="edit btn btn-success btn-edit">Sửa</a>';
                    return $btn;
                })
                ->addColumn('created_at', function($row) {
                    return date('d-m-Y', strtotime($row->created_at));
                })
                ->addColumn('updated_at', function($row) {
                    return date('d-m-Y', strtotime($row->updated_at));
                })
                ->rawColumns(['action', 'created_at', 'updated_at'])
                ->make(true);

        }
    }
    public function index()
    {
        return view('be.brand.index');
    }

    public function createSlug($slug) {
        $slug = Str::slug($slug);
        return $slug;
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
    public function validationForm($request, $id = null)
    {
        $rules = [
            'name' => 'required|unique:brands,name',
        ];

        $messages = [
            'name.required' => 'Tên thương hiệu không được để trống',
            'name.unique' => 'Tên thương hiệu đã tồn tại',
        ];

        if ($id) {
            $rules['name'] .= ',' . $id;
        }

        $request->validate($rules, $messages);
    }
    public function store(Request $request)
    {
        $this->validationForm($request);
        Brand::query()->create([
            'name' => $request->name,
            'slug' => $this->createSlug($request->name)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thêm mới thành công'
        ], Response::HTTP_OK);
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
        $item = Brand::query()->findOrFail($id);
        return response()->json(['data'=>$item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validationForm($request, $id);
        $brand = Brand::query()->findOrFail($id);
        $brand->name = $request->name;
        $brand->slug = $this->createSlug($request->name);
        $brand->save();
        return response()->json([
            'success' => true,
            'message' => 'Cập nhật thành công'
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::query()->findOrFail($id);
        $brand->delete();
        return response()->json([
            'success' => true,
            'message' => 'Xóa thành công'
        ], Response::HTTP_OK);
    }
}
