<?php

use App\Modules\Product\Controllers\ProductController;
use App\Modules\Product\Controllers\CategoryController;
use App\Modules\Product\Controllers\BrandsController;
use App\Modules\Product\Controllers\WarehouseController;
use App\Modules\Product\Controllers\ProductAttributesController;
use App\Modules\Product\Controllers\AttributesItemController;


Route::group(['middleware' => ['admin'], 'as' => 'admin.', 'prefix' => 'admin'], function () {

    //products Controller
    Route::resource('products', ProductController::class);
    Route::get('properties/{id}', [ProductController::class, 'properties'])->name('product.properties');
    Route::post('products-delete-all', [ProductController::class, 'deleteAll'])->name('products.deleteAll');
    Route::post('products-attributes', [ProductController::class, 'Attributes'])->name('products.Attributes');

    //category product controller
    Route::resource('product-categories', CategoryController::class);
    Route::post('product-categories-delete-all', [CategoryController::class, 'deleteAll'])->name('product-categories.deleteAll');

    //warehouse
    Route::resource('warehouse', WarehouseController::class);

    //attributes
    Route::resource('product-attributes', ProductAttributesController::class);
    Route::post('product-attributes-delete-all', [ProductAttributesController::class, 'deleteAll'])->name('product-attributes.deleteAll');
    Route::resource('product_attribute_item', AttributesItemController::class);
    Route::post('category-delete-all', [AttributesItemController::class, 'deleteAll'])->name('categoriess.deleteAll');

    ///product_brands
    Route::resource('brands', BrandsController::class);
    Route::post('brands-all', [BrandsController::class, 'deleteAll'])->name('brands.deleteAll');
});


