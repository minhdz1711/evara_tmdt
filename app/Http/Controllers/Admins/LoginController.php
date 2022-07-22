<?php

namespace App\Http\Controllers\Admins;

use App\Http\Requests\User\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Auth;

class LoginController extends AdminController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {

        if (\Auth::check()) {
            return redirect()->route('admin.dashboard');
        } else {
            return view('admins.auth.login');
        }
    }

    /**
     * @param StoreRquest $request
     */
    public function store(LoginRequest $request)
    {
        $user = User::where([['email', $request->get('email')], ['is_active', 0]])->first();
        $remember = $request->has('remember') ? true : false;
        if (is_object($user) == null) {
            if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')], $remember)) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->back()->with('error', 'Tài khoản của bạn không đúng!!!');
            }
        } else {
            return redirect()->back()->with('error', 'Tài khoản của bạn không hoạt động!!!');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->back();
    }
}
