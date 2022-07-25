<?php

use App\Modules\Menu\Controllers\MenuController;
use App\Modules\Menu\Controllers\MenuPositionController;
use App\Modules\Menu\Controllers\MenuItemController;

Route::group(['middleware' => ['admin'], 'as' => 'admin.', 'prefix' => 'admin'], function () {

    //menu Controller
    Route::resource('menus', MenuController::class);
    Route::post('menus-delete-all', [MenuController::class, 'deleteAll'])->name('menus.deleteAll');

    //menu item controller
    Route::get('menu-items/{id}', [MenuItemController::class, 'index'])->name('menu-items.index');
    Route::post('menu-item/add', [MenuItemController::class, 'addMenu'])->name('menu-item.store');
    Route::delete('menu-item/delete/{id}', [MenuItemController::class, 'deleteMenu'])->name('menu-item.delete');
    Route::get('menu-item/modal/edit/', [MenuItemController::class, 'modelEditMenu'])->name('menu-item.modal.edit');
    Route::post('menu-item/update/{id}', [MenuItemController::class, 'update'])->name('menu-item.update');
    Route::post('menu-item/deleteAll', [MenuItemController::class, 'deleteAll'])->name('menu-item.deleteAll');
    Route::post('menu-item/save/sort', [MenuItemController::class, 'saveSortMenu'])->name('menu-item.saveSort');

    //menu position controller
    Route::resource('menu-positions', MenuPositionController::class);
    Route::post('menu-positions-delete-all', [MenuPositionController::class, 'deleteAll'])->name('menu_positions.deleteAll');
});
