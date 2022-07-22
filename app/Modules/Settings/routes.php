<?php

use App\Modules\Settings\Controllers\SettingController;

Route::group(['middleware' => 'admin', 'as' => 'admin.', 'prefix' => 'admin'], function () {
    Route::resource('settings', SettingController::class);
});
