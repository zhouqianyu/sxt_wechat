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
//index
Route::get('index','IndexController@index')->name('index');

//cart
Route::post('cart/change','CartController@change');
Route::get('cart','CartController@view')->name('cart');
Route::get('order','OrderController@view')->name('order');
Route::get('order/confirm','OrderController@confirm')->name('confirm');
Route::get('order/submit','OrderController@submit')->name('submit');
Route::get('order/pay','OrderController@pay')->name('pay');
Route::get('order/myOrder','OrderController@myOrder')->name('myOrder');
Route::get('order/detail','OrderController@detail')->name('detail');
Route::get('order/cancel','OrderController@cancel');