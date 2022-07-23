<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogLoginController extends AdminController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $data = [
            'title' => 'Quản lý lịch sử đăng nhập',
            'histories' => DB::table('authentication_log')->paginate(15)
        ];
        return view('User::log')->with($data);
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
            DB::table('authentication_log')->whereIn('id', $id)->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Xoá lịch sử đăng nhập thành công !!!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ]);
        }
    }
}
