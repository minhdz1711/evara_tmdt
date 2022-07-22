<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Modules\Banner\Models\Banner;
use App\Modules\Slide\Models\Slide;
use Cache;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        if (!app()->runningInConsole()) {
           $settings = Setting::all()->pluck('value', 'key');
            View::share('settings', $settings);

//
//            $banner = Banner::where('is_active', 1)->where('order', 1)->select('title', 'images')->get();
//            View::share('banner', $banner);
//
//            $slides = Slide::where('is_active', 1)->select('title', 'link', 'images')->get();
//            View::share('slides', $slides);

        }
        Schema::defaultStringLength(191);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
    }
}
