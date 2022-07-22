<?php

use App\Modules\Frontend\Controllers\IndexController;

$middleware = ["web"];
if (env('LOGIN') === true) {
    $middleware = ["web"];
}
Route::group(['middleware' => $middleware, 'module' => 'Frontend'], function () {
    //show home
    Route::get('/', ['as' => 'home', IndexController::class, 'index'])->name('index');
    // product detail
    Route::get('/san-pham/{product_slug}.html', [IndexController::class, 'viewProduct'])->name('Product.viewProduct');
    //post
    Route::get('/bai-viet', [IndexController::class, 'viewPosts'])->name('Post.viewPosts');
    // post detail
    Route::get('{post_slug}.h', [IndexController::class, 'viewPost'])->name('Post.viewPost');
    //comment
    Route::post('/load-comment', [IndexController::class, 'load_comment']);
    Route::post('/send-comment', [IndexController::class, 'send_comment']);
    // products category
    Route::get('{category_slug}.htm', [IndexController::class, 'ProductCatView'])->name('Product.ProductCatView');
    // product search
    Route::get('/search', [IndexController::class, 'viewSearchProduct'])->name('Product.viewSearchProduct');
    // cart
    Route::post('/add-cart', [IndexController::class, 'addCart']);
    Route::get('/cart', [IndexController::class, 'Cart'])->name('cart');
    Route::get('/delete-cart/{rowId}', [IndexController::class, 'deleteCartItem']);
    Route::post('/update-cart-quantity', [IndexController::class, 'updateCartQuantity']);
    //checkout
    Route::get('/login-checkout', [IndexController::class, 'login_checkout'])->name('loginCheckout');
    Route::get('/logout-checkout', [IndexController::class, 'logout_checkout'])->name('logoutCheckout');
    Route::post('/add-member', [IndexController::class, 'add_member'])->name('addMember');
    Route::post('/save-shipping', [IndexController::class, 'save_shipping'])->name('saveShipping');
    Route::get('/checkout', [IndexController::class, 'checkout'])->name('checkout');
    Route::post('/order-place', [IndexController::class, 'orderPlace'])->name('orderPlace');
    Route::get('/handcash', [IndexController::class, 'handCash'])->name('handCash');


});


