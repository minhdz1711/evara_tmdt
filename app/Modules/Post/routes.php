<?php

use App\Modules\Post\Controllers\PostController;
use App\Modules\Post\Controllers\CategoryController;

Route::group(['middleware' => ['admin'], 'as' => 'admin.', 'prefix' => 'admin'], function () {

    //post Controller
    Route::resource('posts', PostController::class);
    Route::post('posts-delete-all', [PostController::class, 'deleteAll'])->name('posts.deleteAll');

    //category
    Route::resource('post-categories', CategoryController::class);
    Route::post('post-categories-delete-all', [CategoryController::class, 'deleteAll'])->name('post-category.deleteAll');
});
