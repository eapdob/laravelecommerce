<?php

use Illuminate\Support\Facades\Route;

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

Route::view('/', 'landing-page');

Route::get('/', 'App\Http\Controllers\LandingPageController@index')->name('landing-page.index');
Route::get('/shop', 'App\Http\Controllers\ShopController@index')->name('shop.index');
Route::get('/shop/{product}', 'App\Http\Controllers\ShopController@show')->name('shop.show');

Route::get('/cart', 'App\Http\Controllers\CartController@index')->name('cart.index');
Route::post('/cart/{product}', 'App\Http\Controllers\CartController@store')->name('cart.store');
Route::patch('/cart/{product}', 'App\Http\Controllers\CartController@update')->name('cart.update');
Route::delete('/cart/{product}', 'App\Http\Controllers\CartController@destroy')->name('cart.destroy');
Route::post('/cart/switchToSaveForLater/{product}', 'App\Http\Controllers\CartController@switchToSaveForLater')->name('cart.switchToSaveForLater');

Route::delete('/saveForLater/{product}', 'App\Http\Controllers\SaveForLaterController@destroy')->name('saveForLater.destroy');
Route::post('/saveForLater/switchToCart/{product}', 'App\Http\Controllers\SaveForLaterController@switchToCart')->name('saveForLater.switchToCart');

Route::post('/coupon', 'App\Http\Controllers\CouponsController@store')->name('coupon.store');
Route::delete('/coupon', 'App\Http\Controllers\CouponsController@destroy')->name('coupon.destroy');

Route::get('/checkout', 'App\Http\Controllers\CheckoutController@index')->name('checkout.index')->middleware('auth');
Route::post('/checkout/store', 'App\Http\Controllers\CheckoutController@store')->name('checkout.store');

Route::get('/guestCheckout', 'App\Http\Controllers\CheckoutController@index')->name('guestCheckout.index');

Route::get('/thankyou', 'App\Http\Controllers\ConfirmationController@index')->name('confirmation.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/search', [App\Http\Controllers\ShopController::class, 'search'])->name('search');

Route::get('/search-algolia', [App\Http\Controllers\ShopController::class, 'searchAlgolia'])->name('search-algolia');

Route::middleware('auth')->group(function () {
    Route::get('/my-profile', [App\Http\Controllers\UsersController::class, 'edit'])->name('users.edit');
    Route::patch('/my-profile', [App\Http\Controllers\UsersController::class, 'update'])->name('users.update');

    Route::get('/my-orders', [App\Http\Controllers\OrdersController::class, 'index'])->name('orders.index');
    Route::get('/my-orders/{order}', [App\Http\Controllers\OrdersController::class, 'show'])->name('orders.show');
});
