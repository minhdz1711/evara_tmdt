<?php

use App\Modules\Pages\Controllers\PageController;

Route::group(['middleware' => ['admin'], 'as' => 'admin.', 'prefix' => 'admin'], function () {
    //post Controller
    Route::resource('pages', PageController::class);
    Route::post('page-delete-all', [PageController::class,'deleteAll'])->name('pages.deleteAll');
});
