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
Route::get('/shop/{id}', 'App\Http\Controllers\ShopController@show')->name('shop.show');

Route::get('/cart', 'App\Http\Controllers\CartController@index')->name('cart.index');
Route::post('/cart', 'App\Http\Controllers\CartController@store')->name('cart.store');
Route::get('/cart/empty', 'App\Http\Controllers\CartController@empty')->name('cart.empty');
Route::delete('/cart/{id}', 'App\Http\Controllers\CartController@destroy')->name('cart.destroy');
Route::post('/cart/switchToSaveForLater/{id}', 'App\Http\Controllers\CartController@switchToSaveForLater')->name('cart.switchToSaveForLater');

Route::get('/saveForLater/empty', 'App\Http\Controllers\SaveForLaterController@empty')->name('saveForLater.empty');
Route::delete('/saveForLater/{id}', 'App\Http\Controllers\SaveForLaterController@destroy')->name('saveForLater.destroy');
Route::post('/saveForLater/switchToCart/{id}', 'App\Http\Controllers\SaveForLaterController@switchToCart')->name('saveForLater.switchToCart');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
