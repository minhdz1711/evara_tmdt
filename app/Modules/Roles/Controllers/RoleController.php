<?php

namespace App\Modules\Roles\Controllers;

use App\Http\Controllers\Admins\AdminController;
use App\Modules\Roles\Requests\UpdateRequest;
use Spatie\Permission\Models\Role;
use App\Modules\Roles\Requests\StoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Quản lý phân quyền',
            'roles' => Role::orderBy('id', 'DESC')->select('id', 'display_name')->paginate(15)
        ];
        return view('Roles::Roles.list')->with($data);
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
            $data = [
                'name' => $request->get('display_name'),
                'guard_name' => 'admin',
                'display_name' => $request->get('display_name')
            ];
            Role::create($data);
            DB::commit();
            return redirect()->route('admin.roles.index')->with('success', 'Thêm nhóm phân quyền thành công !!!');
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
            'title' => 'Sửa phân quyền',
            'role' => Role::where('id', $id)->select('id', 'display_name')->first()
        ];
        return view('Roles::Roles.edit')->with($data);
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
            DB::beginTransaction();
            $data = [
                'name' => $request->get('display_name'),
                'guard_name' => $request->get('display_name'),
                'display_name' => $request->get('display_name')
            ];
            Role::where('id', $id)->update($data);
            DB::commit();
            return redirect()->route('admin.roles.index')->with('success', 'Cập nhật nhóm phân quyền thành công !!!');
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
            Role::where('id', $id)->delete();
            DB::commit();
            return redirect()->route('admin.roles.index')->with('success', 'Xoá nhóm phân quyền thành công !!!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAll(Request $request)
    {
        try {
            $id = $request->get('id');
            DB::beginTransaction();
            Role::whereIn('id', $id)->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Xoá nhóm phân quyền thành công !!!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ]);
        }

    }
}
