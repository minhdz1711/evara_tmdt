<?php

use App\Modules\Comment\Controllers\CommentController;

Route::group(['middleware' => ['admin'], 'as' => 'admin.', 'prefix' => 'admin'], function () {

    //comment Controller
    Route::resource('comments', CommentController::class);
    Route::post('comments-delete-all', [CommentController::class, 'deleteAll'])->name('comments.deleteAll');

});
