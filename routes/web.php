<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});
Route::view('admin','check');

Auth::routes();
Route::group([ 'middleware' => ['auth']], function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('orders', 'Admin\OrderController');
    Route::get('order/{status}', 'Admin\OrderController@filter')->name('order.status');
    Route::post('order/search', 'Admin\OrderController@search')->name('order.search');
    Route::post('order/store', 'Admin\OrderController@selectStore')->name('order.store');
    Route::view('settings','admin.settings.index');

    Route::resource('users', 'Admin\addUserController');
});