<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getUsers(Request $request) {
        if($request->ajax()) {
            $data = User::all();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function($row) {
                    $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'"  class=" btn btn-danger btn-delete-user">Xóa</a>';
                    $btn .= '  <a href="javascript:void(0)" data-id="'.$row->id.'" class="edit btn btn-success btn-edit">Sửa</a>';
                    return $btn;
                })
                //role
                ->addColumn('role', function($row) {
                    $role = implode(', ', $row->roles->pluck('name')->toArray());
                    return $role;
                })
                ->addColumn('avatar', function($row) {
                    $avatar = asset(Storage::url($row->avatar));
                    return $avatar;
                })
                ->rawColumns(['action', 'created_at', 'updated_at'])
                ->make(true);

        }
    }
    public function index()
    {
        $roles = Role::all();
        return view('be.users.index', compact('roles'));
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
            'email' => 'required|unique:users,email',
            'password' => 'required',
        ],
            [
                'name.required' => 'Tên không được để trống',
                'email.required' => 'Email không được để trống',
                'email.unique' => 'Email đã tồn tại',
                'password.required' => 'Mật khẩu không được để trống',
            ]);
        $model = new User();
        $model->fill($request->except(['avatar', 'password']));
        $path = Storage::put('images/avatar', $request->avatar);
        $model->avatar = $path;
        $model->password = bcrypt($request->password);
        if($request->role_id) {
            $roles = $request->role_id;
        }
        $model->syncRoles($roles);
        $model->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Thêm mới thành công',
        ]);
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
        $item = User::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'user' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
        ],
            [
                'name.required' => 'Tên không được để trống',
                'email.required' => 'Email không được để trống',
                'email.unique' => 'Email đã tồn tại',
            ]);
        $model = User::findOrFail($id);
        $model->fill($request->except(['avatar', 'password']));
        if($request->avatar) {
            $path = Storage::put('images/avatar', $request->avatar);
            Storage::delete($model->avatar);
            $model->avatar = $path;
        }
        if($request->password) {
            $model->password = bcrypt($request->password);
        }

        $roles = [];
        if($request->role_id) {
            $roles = $request->role_id;
        }
        $model->syncRoles($roles);

        $model->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Cập nhật thành công',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = User::findOrFail($id);
        $item->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Xóa thành công',
        ]);
    }
}
