<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use App\Models\Category;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getCategory(Request $request) {
        if($request->ajax()) {
            $data = Category::query()->orderByDesc('id')->get();
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
        return view('be.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function validationForm($request, $id = null)
    {
        $rules = [
            'name' => 'required|unique:brands,name',
        ];

        $messages = [
            'name.required' => 'Tên danh mục không được để trống',
            'name.unique' => 'Tên danh mục đã tồn tại',
        ];

        if ($id) {
            $rules['name'] .= ',' . $id;
        }

        $request->validate($rules, $messages);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function createSlug($slug) {
        $slug = Str::slug($slug);
        return $slug;
    }
    public function store(Request $request)
    {
        $this->validationForm($request);
        Category::query()->create([
            'name' => $request->name,
            'slug' => $this->createSlug($request->name),
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
        $category = Category::query()->findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $category
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validationForm($request, $id);
        $category = Category::query()->findOrFail($id);
        $category->update([
            'name' => $request->name,
            'slug' => $this->createSlug($request->name),
        ]);
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
        $category = Category::query()->findOrFail($id);
        $category->delete();
        return response()->json([
            'success' => true,
            'message' => 'Xóa thành công'
        ], Response::HTTP_OK);
    }
}
