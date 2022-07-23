<?php
$namspace='\App\Modules\Banner\Controllers';

Route::group(['middleware' => ['admin'], 'as' => 'admin.', 'prefix' => 'admin', 'namespace' => $namspace], function () {

    //banners Controller
    Route::resource('banners', 'BannerController');
    Route::post('banner-delete-all', 'BannerController@deleteAll')->name('banners.deleteAll');
});