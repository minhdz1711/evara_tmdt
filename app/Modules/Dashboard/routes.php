<?php

use App\Modules\Dashboard\Controllers\DashboardController;

Route::group(['middleware' => 'admin', 'as' => 'admin.', 'prefix' => 'admin'], function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
