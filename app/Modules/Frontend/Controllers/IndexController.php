<?php

namespace App\Modules\Frontend\Controllers;

use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Theme;

class IndexController extends AdminController
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $setting = Setting::all()->pluck('value', 'key');
        $theme = Theme::uses('mmz')->setTitle($setting['website_name']);
        $theme->setFavicon(url($setting['website_favicon']));
        return $theme->watch('index')->render();
    }
}
