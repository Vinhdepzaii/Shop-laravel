<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getRole(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::all();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '"  class=" btn btn-danger btn-delete-role">Xóa</a>';
                    $btn .= '  <a href="javascript:void(0)" data-id="' . $row->id . '" class="edit btn btn-success btn-edit">Sửa</a>';
                    return $btn;
                })
                ->addColumn('created_at', function ($row) {
                    return date('d-m-Y', strtotime($row->created_at));
                })
                ->addColumn('updated_at', function ($row) {
                    return date('d-m-Y', strtotime($row->updated_at));
                })
                ->rawColumns(['action', 'created_at', 'updated_at'])
                ->make(true);

        }
    }

    public function index()
    {
        $permissions = Permission::all()->groupBy('group');
        return view('be.roles.index', compact('permissions'));
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
            'name' => 'required|unique:roles,name',
            'display_name' => 'required',
            'permission_ids' => 'required',
        ],
            [
                'name.required' => 'Tên không được để trống',
                'name.unique' => 'Tên đã tồn tại',
                'display_name.required' => 'Tên hiển thị không được để trống',
                'permission_ids.required' => 'Quyền không được để trống',
            ]);
        $role = Role::create($request->all());
        $permissions = [];
        foreach ($request->permission_ids as $permission_id) {
            $permissions[] = Permission::find($permission_id);
        }
        $role->syncPermissions($permissions);
        return response()->json([
            'message' => 'Thêm mới thành công',
            'success' => true
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
        $role = Role::find($id);
        $permissions = $role->permissions;
        return response()->json([
            'role' => $role,
            'permissions' => $permissions
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
            'display_name' => 'required',
            'permission_ids' => 'required',
        ],
            [
                'name.required' => 'Tên không được để trống',
                'name.unique' => 'Tên đã tồn tại',
                'display_name.required' => 'Tên hiển thị không được để trống',
                'permission_ids.required' => 'Quyền không được để trống',
            ]);
        $role = Role::find($id);
        $role->update($request->all());
        $permissions = [];
        foreach ($request->permission_ids as $permission_id) {
            $permissions[] = Permission::find($permission_id);
        }
        $role->syncPermissions($permissions);
        return response()->json([
            'message' => 'Cập nhật thành công',
            'success' => true
        ], Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        $role->delete();
        return response()->json([
            'message' => 'Xóa thành công',
            'success' => true
        ], Response::HTTP_OK);
    }
}
