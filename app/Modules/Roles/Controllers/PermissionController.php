<?php

namespace App\Modules\Roles\Controllers;

use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data['title'] = "Cấp quyền cho tài khoản";
        $data['role'] = Role::find($id);
        $data['permissions'] = Permission::get();
        $data['rolePermissions'] = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        $result = array();
        foreach ($data['permissions'] as $key => $element) {
            $result[$element['group_name']][] = $element;
        }
        $data['permissions'] = $result;
        return view('Roles::Permission.add-permission')->with($data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $role = Role::find($id);
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('admin.roles.index')->with('success', 'Cấp quyền thành công !!!');
    }
}
