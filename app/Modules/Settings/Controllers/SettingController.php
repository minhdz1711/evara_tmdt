<?php

namespace App\Modules\Settings\Controllers;

use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Cài đặt hệ thống'
        ];
        return view('Settings::list')->with($data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            foreach ($request->all() as $key => $value) {
                DB::table('settings')->where('key', '=', $key)->update(['value' => str_replace(env('APP_URL'), '', $value)]);
            }
            DB::commit();
            return redirect()->route('admin.settings.index')->with('success', 'Cập nhật cài đặt thành công !!!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }
}
