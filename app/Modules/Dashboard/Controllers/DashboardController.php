<?php

namespace App\Modules\Dashboard\Controllers;

use App\Http\Controllers\Admins\AdminController;
use App\Models\User;
use App\Modules\Membership\Models\Membership;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Modules\Order\Models\Order;
use DirectAdmin;

class DashboardController extends AdminController
{
    /**
     * show dashboard
     */
    public function index()
    {
        $title = 'Quản trị hệ thống';
        return view('Dashboard::index', compact('title'));
    }

    /**
     * @param Request $request
     */
    public function updateToggle(Request $request)
    {
        $table = $request->input('table');
        $id = $request->input('id');
        $col = $request->input('col');

        $row = DB::table($table)->where('id', $id)->first();
        if ($row) {
            ($row->$col == 1) ? $update = 0 : $update = 1;
            DB::table($table)->where('id', $id)->update([$col => $update]);
        }
    }

    public function test()
    {
        return DirectAdmin::postAccountAdmin([
            'action' => 'create',
            'username' => 'minhdz1711',
            'passwd' => 'Minhdz_2000@',
            'passwd2' => 'Minhdz_2000@',
            'email' => 'minsd319@gmail.com',
//            'domain' => ''
        ]);
    }
}
