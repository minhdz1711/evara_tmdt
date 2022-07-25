<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admins\LoginController;
use App\Modules\Frontend\Controllers\IndexController;
use App\Modules\Dashboard\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**** Login admin ****/


Route::group(['middleware' => ['web'], 'as' => 'admin.', 'prefix' => 'admin'], function () {
    Route::resource('login', LoginController::class);
});

Route::group(['middleware' => ['admin'], 'as' => 'admin.', 'prefix' => 'admin'], function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/clear-cache', function () {
        \Artisan::call('cache:clear');
        \Artisan::call('view:clear');
        \Artisan::call('route:clear');
        \Artisan::call('config:clear');
        return redirect()->back()->with('success', 'Xoá cache thành công !!!');
        // return what you want
    })->name('remove.cache');

    ///update toggle
    Route::post('update/toggle', [DashboardController::class, 'updateToggle'])->name('updateToggle');
});

//toggle change status
Route::group(['middleware' => ['admin'], 'as' => 'admin.', 'prefix' => 'admin'], function () {
    ///update toggle
    Route::post('update/toggle', [DashboardController::class, 'updateToggle'])->name('updateToggle');
});
//ckfinder
Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');

