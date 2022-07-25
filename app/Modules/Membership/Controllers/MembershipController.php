<?php

namespace App\Modules\Membership\Controllers;

use App\Http\Controllers\Admins\AdminController;
use App\Modules\Membership\Models\Membership;
use App\Modules\Membership\Requests\StoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MembershipController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = ['title' => 'Quản lý tài khoản người dùng'];
        if (isset($request->type) && $request->type != "" || isset($request->keyword)) {
            switch ($request->type) {
                case "all":
                    $data = array_merge($data, [
                        'users' => Membership::select('id', 'display_name', 'username', 'email', 'is_active', 'images', 'created_at')->paginate(10)
                    ]);
                    break;
                case "display_name":
                    $data = array_merge($data, [
                        'users' => Membership::where('display_name', 'like', '%' . $request->keyword . '%')->orderBy('id', 'DESC')->select('id', 'display_name', 'username', 'email', 'is_active', 'images', 'created_at')->paginate(10),
                    ]);
                    break;
                case "email":
                    $data = array_merge($data, [
                        'users' => Membership::where('email', 'like', '%' . $request->keyword . '%')->orderBy('id', 'DESC')->select('id', 'display_name', 'username', 'email', 'is_active', 'images', 'created_at')->paginate(10),
                    ]);
                    break;
                case "username":
                    $data = array_merge($data, [
                        'users' => Membership::where('username', 'like', '%' . $request->keyword . '%')->orderBy('id', 'DESC')->select('id', 'display_name', 'username', 'email', 'is_active', 'images', 'created_at')->paginate(10),
                    ]);
                    break;
                case "status":
                    if ($request->keyword == "Inactive") {
                        $data = array_merge($data, [
                            'users' => Membership::where('is_active', 0)->orderBy('id', 'DESC')->select('id', 'display_name', 'username', 'email', 'is_active', 'images', 'created_at')->paginate(10),
                        ]);
                    } elseif ($request->keyword == "Active") {
                        $data = array_merge($data, [
                            'users' => Membership::where('is_active', 1)->orderBy('id', 'DESC')->select('id', 'display_name', 'username', 'email', 'is_active', 'images', 'created_at')->paginate(10),
                        ]);
                    } else {
                        $data = array_merge($data, [
                            'users' => Membership::select('id', 'display_name', 'username', 'email', 'is_active', 'images', 'created_at')->orderBy('id', 'DESC')->paginate(15)
                        ]);
                    }
                    break;
            }
        } else {
            $data = array_merge($data, [
                'users' => Membership::select('id', 'display_name', 'username', 'email', 'is_active', 'images', 'created_at')->orderBy('id', 'DESC')->paginate(10)
            ]);
        }

        return view('Membership::list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['title' => 'Thêm tài khoản mới'];
        return view('Membership::create')->with($data);
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
            $data = array_merge($request->only(['display_name', 'email', 'username', 'email', 'phone', 'gender']), [
                'images' => $this->getImages($request->get('images')),
                'password' => bcrypt($request->get('password')),
                'is_active'=>1,
            ]);
            Membership::create($data);
            DB::commit();
            return redirect()->route('admin.memberships.index')->with('success', 'Thêm tài khoản thành công !!!');
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
            'title' => 'Sửa tài khoản người dùng',
            'user' => Membership::where('id', $id)->first()
        ];

        return view('Membership::edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = array_merge($request->only(['display_name', 'email', 'username', 'email', 'phone', 'gender']), [
                'images' => $this->getImages($request->get('images')),
            ]);
            if ($request->get('password') != "") {
                $data = array_merge($data, [
                    'password' => bcrypt($request->get('password'))
                ]);
            }
            Membership::where('id', $id)->update($data);
            DB::commit();
            return redirect()->route('admin.memberships.index')->with('success', 'Cập nhật tài khoản thành công !!!');
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
            Membership::where('id', $id)->delete();
            DB::commit();
            return redirect()->route('admin.memberships.index')->with('success', 'Xoá tài khoản thành công !!!');
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
            Membership::whereIn('id', $id)->delete();
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
