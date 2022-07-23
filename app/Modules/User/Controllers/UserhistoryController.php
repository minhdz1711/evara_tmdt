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
use App\Modules\User\Models\Actionhistoryuser;

class UserhistoryController extends AdminController
{


    public function edit($id)
    {
        try {
            $data = [
                'title' => 'Lịch Sử',
                'userse' => User::where('id', $id)->first(),
                'history' => Actionhistoryuser::where('users_id', $id)->select('id','type','work','content','created_at')->orderBy('id', 'DESC')->paginate(15)
            ];
            return view('User::historys')->with($data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }
}

/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request $request
 * @param  int $id
 * @return \Illuminate\Http\Response
 */

