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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
