<?php

$namspace='\App\Modules\Slide\Controllers';

Route::group(['middleware' => ['admin'], 'as' => 'admin.', 'prefix' => 'admin', 'namespace' => $namspace], function () {

    //slide Controller
    Route::resource('slides', 'SlideController');
    Route::post('slide-delete-all', 'SlideController@deleteAll')->name('slides.deleteAll');
});