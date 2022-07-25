<?php

$namspace='\App\Modules\Membership\Controllers';

Route::group(['middleware' => ['admin'], 'as' => 'admin.', 'prefix' => 'admin', 'namespace' => $namspace], function () {
    //memberships controller
    Route::resource('memberships', 'MembershipController');
    Route::post('memberships-delete-all', 'MembershipController@deleteAll')->name('memberships.deleteAll');

    //log memberships login controller
    Route::get('memberships/login-logs', 'LogMembershipController@index')->name('memberships.logs');
    Route::post('memberships/delete-login-logs', 'LogMembershipController@deleteAll')->name('memberships.logs.deleteAll');
});
