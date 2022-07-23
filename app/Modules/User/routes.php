<?php

use App\Modules\User\Controllers\UserController;
use App\Modules\User\Controllers\LogLoginController;
use App\Modules\User\Controllers\ProfileController;

Route::group(['middleware' => ['admin'], 'as' => 'admin.', 'prefix' => 'admin'], function () {
    //user controller
    Route::resource('users', UserController::class);
    Route::post('user-delete-all', [UserController::class, 'deleteAll'])->name('users.deleteAll');

    //log login controller
    Route::get('user/login-logs', [LogLoginController::class, 'index'])->name('users.logs');
    Route::post('user/delete-login-logs', [LogLoginController::class, 'deleteAll'])->name('users.logs.deleteAll');

    //profile controller
    Route::get('/user/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/user/profile/{user}', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/user/update-password/{user}', [ProfileController::class, 'updatePassword'])->name('profile.password');

    //action history user controller
    Route::resource('historys', UserhistoryController::class);
});
