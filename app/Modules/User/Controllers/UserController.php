<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\User;
use App\Modules\User\Requests\StoreRequest;
use App\Modules\User\Requests\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = ['title' => 'Quản lý tài khoản quản trị'];
        if (isset($request->type) && $request->type != "" || isset($request->keyword)) {
            switch ($request->type) {
                case "all":
                    $data = array_merge($data, [
                        'users' => User::select('id', 'display_name', 'username', 'email', 'position', 'is_active', 'images', 'created_at')->paginate(15)
                    ]);
                    break;
                case "display_name":
                    $data = array_merge($data, [
                        'users' => User::where('display_name', 'like', '%' . $request->keyword . '%')->orderBy('id', 'DESC')->select('id', 'display_name', 'username', 'email', 'position', 'is_active', 'images', 'created_at')->paginate(15),
                    ]);
                    break;
                case "email":
                    $data = array_merge($data, [
                        'users' => User::where('email', 'like', '%' . $request->keyword . '%')->orderBy('id', 'DESC')->select('id', 'display_name', 'username', 'email', 'position', 'is_active', 'images', 'created_at')->paginate(15),
                    ]);
                    break;
                case "username":
                    $data = array_merge($data, [
                        'users' => User::where('username', 'like', '%' . $request->keyword . '%')->orderBy('id', 'DESC')->select('id', 'display_name', 'username', 'email', 'position', 'is_active', 'images', 'created_at')->paginate(15),
                    ]);
                    break;
                case "status":
                    if ($request->keyword == "Inactive") {
                        $data = array_merge($data, [
                            'users' => User::where('is_active', 0)->orderBy('id', 'DESC')->select('id', 'display_name', 'username', 'email', 'position', 'is_active', 'images', 'created_at')->paginate(15),
                        ]);
                    } elseif ($request->keyword == "Active") {
                        $data = array_merge($data, [
                            'users' => User::where('is_active', 1)->orderBy('id', 'DESC')->select('id', 'display_name', 'username', 'email', 'position', 'is_active', 'images', 'created_at')->paginate(15),
                        ]);
                    } else {
                        $data = array_merge($data, [
                            'users' => User::select('id', 'display_name', 'username', 'email', 'position', 'is_active', 'images', 'created_at')->orderBy('id', 'DESC')->paginate(15)
                        ]);
                    }
                    break;
            }
        } else {
            $data = array_merge($data, [
                'users' => User::select('id', 'display_name', 'username', 'email', 'position', 'is_active', 'images', 'created_at')->orderBy('id', 'DESC')->paginate(15)
            ]);
        }

        return view('User::list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Tạo tài khoản quản trị mới',
            'roles' => Role::select('id', 'display_name')->get()
        ];
        return view('User::create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = array_merge($request->only(['display_name', 'email', 'username', 'email', 'position', 'phone', 'gender']), [
                'images' => $this->getImages($request->get('images')),
                'password' => bcrypt($request->get('password'))
            ]);
            $user = User::create($data);
            dd($user);

            //set permission
            $position = Config::showRoles($request->get('position'));
            $role = Role::where('display_name', $position)->first();
            $array_permision = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $role->id)
                ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
                ->all();
            $permissions = Permission::whereIn('id', $array_permision)->pluck('id', 'id')->all();
            $role->syncPermissions($permissions);
            $user->assignRole([$role->id]);
            DB::commit();
            return redirect()->route('admin.users.index')->with('success', 'Thêm tài khoản thành công !!!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'title' => 'Sửa tài khoản quản trị',
            'roles' => Role::select('id', 'display_name')->get(),
            'user' => User::where('id', $id)->first()
        ];

        return view('User::edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $user = User::find($id);
            DB::beginTransaction();
            $data = array_merge($request->only(['display_name', 'email', 'username', 'email', 'position', 'phone', 'gender']), [
                'images' => $this->getImages($request->get('images')),
            ]);
            if ($request->get('password') != "") {
                $data = array_merge($data, [
                    'password' => bcrypt($request->get('password'))
                ]);
            }
            User::where('id', $id)->update($data);

            //set permission
            $role = Role::where('id', $request->get('position'))->first();
            $array_permision = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $role->id)
                ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
                ->all();
            $permissions = Permission::whereIn('id', $array_permision)->pluck('id', 'id')->all();
            $role->syncPermissions($permissions);
            $user->syncRoles([$role->id]);
            DB::commit();
            return redirect()->route('admin.users.index')->with('success', 'Cập nhật tài khoản thành công !!!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            User::where('id', $id)->delete();
            DB::commit();
            return redirect()->route('admin.users.index')->with('success', 'Xoá tài khoản thành công !!!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAll(Request $request)
    {
        try {
            $id = $request->get('id');
            DB::beginTransaction();
            User::whereIn('id', $id)->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Xoá tài khoản quản trị thành công !!!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ]);
        }
    }
}
