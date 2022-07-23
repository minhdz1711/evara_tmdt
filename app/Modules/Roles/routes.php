<?php

use App\Modules\Roles\Controllers\RoleController;
use App\Modules\Roles\Controllers\PermissionController;

Route::group(['middleware' => ['admin'], 'as' => 'admin.', 'prefix' => 'admin'], function () {

    //role Controller
    Route::resource('roles', RoleController::class);
    Route::post('role-delete-all', [RoleController::class, 'deleteAll'])->name('roles.deleteAll');

    Route::get('add-role/{id}', [PermissionController::class, 'index'])->name('roles.getAdd');
    Route::post('add-role/{id}', [PermissionController::class, 'store'])->name('roles.postAdd');
});
