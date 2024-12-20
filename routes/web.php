<?php

use App\Http\Controllers\FrontendUser\OrderUserController;
use App\Http\Controllers\FrontendUser\PageController;
use App\Http\Controllers\FrontendUser\PaymentController;
use App\Http\Controllers\FrontendUser\ProductUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function() {
// ----------------------------- home dashboard ------------------------------//
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// -----------------------------login----------------------------------------//
Route::get('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'authenticate']);
Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

// ------------------------------ register ---------------------------------//
Route::get('/register', [App\Http\Controllers\RegisterController::class, 'register'])->name('register');
Route::post('/register', [App\Http\Controllers\RegisterController::class, 'storeUser'])->name('register');

// ------------------------------ menu_levels ---------------------------------//
Route::get('menu', [App\Http\Controllers\MenuController::class, 'index'])->middleware('auth')->name('menu.show');
Route::post('menu', [App\Http\Controllers\MenuController::class, 'store'])->middleware('auth')->name('menu.store');
Route::post('menu/{id}', [App\Http\Controllers\MenuController::class, 'update'])->middleware('auth')->name('menu.update');
Route::get('menu/delete/{id}', [App\Http\Controllers\MenuController::class, 'destroy'])->middleware('auth')->name('menu.destroy');

// ------------------------------ menu_user ---------------------------------//
Route::get('menuUser', [App\Http\Controllers\MenuUserController::class, 'index'])->middleware('auth')->name('menuUser.show');
Route::post('menuUser', [App\Http\Controllers\MenuUserController::class, 'store'])->middleware('auth')->name('menuUser.store');
Route::post('menuUser/{id}', [App\Http\Controllers\MenuUserController::class, 'update'])->middleware('auth')->name('menuUser.update');
Route::get('menuUser/{id}', [App\Http\Controllers\MenuUserController::class, 'destroy'])->middleware('auth')->name('menuUser.destroy');

// ----------------------------- Jenis User ------------------------------//
Route::get('jenisUser', [App\Http\Controllers\JenisUserController::class, 'show'])->name('jenisUser.show');
Route::post('jenisUser', [App\Http\Controllers\JenisUserController::class, 'store'])->name('jenisUser.store');
Route::post('jenisUser/{id}', [App\Http\Controllers\JenisUserController::class, 'update'])->name('jenisUser.update');
Route::get('jenisUser/{id}', [App\Http\Controllers\JenisUserController::class, 'destroy'])->middleware('auth')->name('jenisUser.destroy');

// ----------------------------- User ------------------------------//
Route::get('user', [App\Http\Controllers\UserController::class, 'show'])->middleware('auth')->name('user.show');
Route::post('user', [App\Http\Controllers\UserController::class, 'store'])->middleware('auth')->name('user.store');
Route::post('user/{id}', [App\Http\Controllers\UserController::class, 'update'])->middleware('auth')->name('user.update');
Route::get('user/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->middleware('auth')->name('user.destroy');

// ----------------------------- profile ------------------------------//
Route::get('profile', [App\Http\Controllers\ProfileController::class, 'showProfile'])->middleware('auth')->name('profile.show');
Route::post('profile/update', [App\Http\Controllers\ProfileController::class, 'updateBiodata'])->middleware('auth')->name('profile.update');

// for admin
Route::resource('categories', \App\Http\Controllers\CategoryController::class);
Route::resource('attributes', \App\Http\Controllers\AttributeController::class);
Route::resource('attributes.attribute_options', \App\Http\Controllers\AttributeOptionsController::class);
Route::resource('products', \App\Http\Controllers\ProductController::class);
Route::resource('products.product_images', \App\Http\Controllers\ProductImageController::class);

// slide
Route::resource('slides', \App\Http\Controllers\SlideController::class);
Route::get('slides/{slideId}/up', [\App\Http\Controllers\SlideController::class, 'moveUp']);
Route::get('slides/{slideId}/down', [\App\Http\Controllers\SlideController::class, 'moveDown']);

// order
Route::get('orders/trashed', [\App\Http\Controllers\OrderController::class , 'trashed'])->name('orders.trashed');
Route::get('orders/restore/{order:id}', [\App\Http\Controllers\OrderController::class , 'restore'])->name('orders.restore');
Route::resource('orders', \App\Http\Controllers\OrderController::class);
Route::post('orders/complete/{order}', [\App\Http\Controllers\OrderController::class , 'doComplete'])->name('orders.complete');
Route::get('orders/{order:id}/cancel', [\App\Http\Controllers\OrderController::class , 'cancel'])->name('orders.cancels');
Route::put('orders/cancel/{order:id}', [\App\Http\Controllers\OrderController::class , 'doCancel'])->name('orders.cancel');
Route::resource('shipments', \App\Http\Controllers\ShipmentController::class);

// report
Route::get('reports/revenue', [\App\Http\Controllers\ReportController::class, 'revenue'])->name('reports.revenue');
Route::get('reports/product', [\App\Http\Controllers\ReportController::class, 'product'])->name('reports.product');
Route::get('reports/inventory', [\App\Http\Controllers\ReportController::class, 'inventory'])->name('reports.inventory');
Route::get('reports/payment', [\App\Http\Controllers\ReportController::class, 'payment'])->name('reports.payment');
});


// //USER
// //cart
// Route::get('/carts', [PageController::class, 'carts'])->name('carts');
// Route::post('cart/add-carts/{id}',[PageController::class, 'addtoCarts'])->name('cart.add');
// Route::post('carts/update-cart/{id}',[PageController::class, 'updateCart'])->name('cart.upate');
// Route::delete('cart/remove-cart/{id}', [PageController::class, 'removefromCart'])->name('cart.remove');
// Route::delete('cart/clear', [PageController::class, 'clearCart'])->name('cart.clear');

// //wishlist
// Route::get('/wishlist', [PageController::class, 'wishlist'])->name('wishlist');
// Route::post('wishlist/add-wish/{id}', [PageController::class, 'store'])->name('wishlist.store');
// Route::delete('/wishlist/clear', [PageController::class, 'destroy'])->name('wishlist.destroy');

// //order
// Route::get('/order', [OrderUserController::class, 'index'])->name('orders');
// Route::get('/orders/creta', [OrderUserController::class, 'create']);
// Route::post('/orders', [OrderUserController::class, 'store']);
// Route::get('/orders/{id}', [OrderUserController::class, 'show']);
// Route::get('/orders/{id}/edit', [OrderUserController::class, 'edit']);
// Route::put('/orders/update', [OrderUserController::class, 'update']);
// Route::delete('/orders/delete', [OrderUserController::class, 'destroy']);

// //product
// // Route::resource('products', ProductUserController::class)->only(['index', 'show']);
// // Route::get('products/jenis', [ProductUserController::class, 'jenis'])->name('products.jenis');
// // Route::get('products/jenis/{id}', [ProductUserController::class, 'detailjenis'])->name('products.detailjenis');

// //payment
// Route::get('payments', [PaymentController::class, 'index'])->name('payments');
// Route::get('payments/{id}', [PaymentController::class, 'show'])->name('payments.show');

// // use App\Http\Controllers\ProductController;
// // use App\Http\Controllers\ProfileController;

// // Route::get('/jenis-product', [ProductController::class, 'index'])->name('jenis.product');
// // Route::get('/jenis-product/{id}', [ProductController::class, 'detailJenis'])->name('jenis.detail');
// // Route::get('/product/{id}', [ProductController::class, 'detailProduct'])->name('product.detail');
// // Route::get('/pembayaran', [ProductController::class, 'pembayaran'])->name('pembayaran');
// // Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');

// // use App\Http\Controllers\PageController;

// // Route::get('/carts', [PageController::class, 'carts'])->name('user.frontend.carts');
// // Route::get('/orders', [PageController::class, 'orders'])->name('orders');
// // Route::get('/products', [PageController::class, 'products'])->name('user.frontend.detail_product');
// // Route::get('/wishlist', [PageController::class, 'wishlist'])->name('wishlist');

// -----------------------------login----------------------------------------//
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'authenticate']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// ------------------------------ register ---------------------------------//
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'storeUser'])->name('register');


Route::get('/', [\App\Http\Controllers\FrontendUser\HomepageController::class, 'index']);
Route::get('products', [\App\Http\Controllers\FrontendUser\ProductUserController::class, 'index']);
Route::get('product/{product:slug}', [\App\Http\Controllers\FrontendUser\ProductUserController::class, 'show'])->name('product.detail');
Route::get('products/quick-view/{product:slug}', [\App\Http\Controllers\FrontendUser\ProductUserController::class, 'quickView']);

Route::get('carts', [\App\Http\Controllers\FrontendUser\CartController::class, 'index'])->name('carts.index');
Route::post('carts', [\App\Http\Controllers\FrontendUser\CartController::class, 'store'])->name('carts.store');
Route::post('carts/update', [\App\Http\Controllers\FrontendUser\CartController::class, 'update']);
Route::get('carts/remove/{cartId}', [\App\Http\Controllers\FrontendUser\CartController::class, 'destroy']);

Route::group(['middleware' => 'auth'], function() {
    Route::get('orders/checkout', [\App\Http\Controllers\FrontendUser\OrderUserController::class, 'checkout'])->middleware('auth');
    Route::post('orders/checkout', [\App\Http\Controllers\FrontendUser\OrderUserController::class, 'doCheckout'])->name('orders.checkout')->middleware('auth');
    Route::get('orders/cities', [\App\Http\Controllers\FrontendUser\OrderUserController::class, 'cities'])->middleware('auth');
    Route::post('orders/shipping-cost', [\App\Http\Controllers\FrontendUser\OrderUserController::class, 'shippingCost'])->middleware('auth');
    Route::post('orders/set-shipping', [\App\Http\Controllers\FrontendUser\OrderUserController::class, 'setShipping'])->middleware('auth');
    Route::get('orders/received/{orderId}', [\App\Http\Controllers\FrontendUser\OrderUserController::class, 'received']);
    Route::get('orders', [\App\Http\Controllers\FrontendUser\OrderUserController::class, 'index']);
    Route::get('orders/{orderId}', [\App\Http\Controllers\FrontendUser\OrderUserController::class, 'show']);

    Route::resource('wishlists', \App\Http\Controllers\FrontendUser\WishListController::class)->only(['index','store','destroy']);

    Route::get('profile',  [\App\Http\Controllers\ProfileController::class, 'index']);
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update']);
});

// Route::get('payments/notification', [\App\Http\Controllers\FrontendUser\PaymentController::class, 'notification']);
Route::get('payments/completed', [\App\Http\Controllers\FrontendUser\PaymentController::class, 'completed']);
Route::get('payments/failed', [\App\Http\Controllers\FrontendUser\PaymentController::class, 'failed']);
Route::get('payments/unfinish', [\App\Http\Controllers\FrontendUser\PaymentController::class, 'unfinish']);

