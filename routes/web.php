<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'LandingPageController@index')->name('landing-page');

Route::get('/shop', 'ShopController@index')->name('shop.index');
Route::get('/shop/{product}', 'ShopController@show')->name('shop.show');

Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart', 'CartController@store')->name('cart.store');
Route::patch('/cart/{product}', 'CartController@update')->name('cart.update');
Route::delete('/cart/{product}', 'CartController@destroy')->name('cart.destroy');
Route::post('/cart/switch_to_save_for_later/{product}', 'CartController@switchToSaveForLater')->name('cart.switchToSaveForLater');

Route::delete('/saveForLater/{product}', 'SaveForLaterController@destroy')->name('saveForLater.destroy');
Route::post('/saveForLater/switch_to_cart/{product}', 'SaveForLaterController@switchToCart')->name('saveForLater.switchToCart');

Route::post('/coupon', 'CouponController@store')->name('coupon.store');
Route::delete('/coupon', 'CouponController@destroy')->name('coupon.destroy');

Route::middleware('auth')->group(function() {
    Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
    Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');
    Route::get('/my/profile', 'UserController@profileEdit')->name('users.profile.edit');
    Route::patch('/my/profile', 'UserController@profileUpdate')->name('users.profile.update');
    Route::get('/my/order', 'UserController@orderIndex')->name('users.order.index');
});

Route::get('/thanks', 'StaticHtmlController@thanks')->name('static.thanks');
Route::get('/search', 'ShopController@search')->name('search');

Auth::routes();
Route::get('/auth/google', 'Auth\LoginController@redirectToGoogle')->name('google.login');
Route::get('/auth/google/callback', 'Auth\LoginController@handleGoogleCallback')->name('google.login.callback');
