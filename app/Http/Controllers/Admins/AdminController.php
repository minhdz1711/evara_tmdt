<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    public function __construct()
    {

        //settings
        $settings = Setting::all()->pluck('value', 'key');
        if (!count($settings) > 0) {
            print_r('Empty setting!');
            die();
        }

        View::share('settings', $settings);
    }

    /**
     * @param $images
     * @return mixed
     */
    public function getImages($images)
    {
        $images = str_replace(env('APP_URL'), '', $images);
        return $images;
    }

    /**
     * @param $value1
     * @param $value2
     * @param $value3
     * @param $value4
     */
    public function getDataContact($value1, $value2, $value3, $value4, $value5)
    {
        $data_contact = [];
        foreach ($value1 as $key => $value) {
            $data_contact[$key]['company'] = $value;
        }
        foreach ($value2 as $key => $value) {
            $data_contact[$key]['name'] = $value;
        }
        foreach ($value3 as $key => $value) {
            $data_contact[$key]['address'] = $value;
        }
        foreach ($value4 as $key => $value) {
            $data_contact[$key]['phone'] = $value;
        }
        foreach ($value5 as $key => $value) {
            $data_contact[$key]['id'] = $value;
        }
        return $data_contact;
    }
}
