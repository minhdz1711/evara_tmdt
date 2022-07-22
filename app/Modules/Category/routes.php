<?php

use App\Modules\Category\Controllers\CategoryController;

Route::group(['middleware' => ['admin'], 'as' => 'admin.', 'prefix' => 'admin'], function () {

    //category
    Route::resource('categories', CategoryController::class);
    Route::post('category-delete-all', [CategoryController::class, 'deleteAll'])->name('categories.deleteAll');
});
