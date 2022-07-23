<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Modules\User\Requests\UpdatePassword;
use App\Modules\User\Requests\UpdateProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends AdminController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data = [
            'title' => 'Thông tin tài khoản'
        ];
        return view('User::profile')->with($data);
    }

    /**
     * @param UpdateProfile $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(UpdateProfile $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = array_merge($request->only(['display_name', 'email', 'username', 'phone', 'gender']), [
                'images' => $this->getImages($request->get('images')),
            ]);
            User::where('id', $id)->update($data);
            DB::commit();
            return redirect()->back()->with('success', 'Cập nhật thông tin thành công thành công !!!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    /**
     * @param UpdatePassword $request
     * @param $id
     */
    public function updatePassword(UpdatePassword $request, $id)
    {
        try {
            DB::beginTransaction();
            $user = User::where('id', $id)->first();
            if (Hash::check($request->get('password_current'), $user->password)) {
                if ($request->get('pw_1') == $request->get('pw_2')) {
                    $data = [
                        'password' => bcrypt($request->get('pw_1'))
                    ];
                    User::where('id', $id)->update($data);
                    DB::commit();
                    return redirect()->back()->with('success', 'Đổi mật khẩu thành công thành công !!!');
                } else {
                    return redirect()->back()->with('error', 'Mật khẩu mới bạn nhập không khớp !!!');
                }
            } else {
                return redirect()->back()->with('error', 'Mật khẩu bạn nhập không đúng !!!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }
}
