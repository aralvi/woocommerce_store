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
    return view('auth/login');
});
Route::view('admin','check');

Auth::routes();
Route::group([ 'middleware' => ['auth']], function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('orders', 'Admin\OrderController');
    Route::get('order/detail','Admin\OrderController@singleOrderDetail')->name('single.order.detail');
    // Route::get('order/{status}', 'Admin\OrderController@filter')->name('order.status');
    Route::post('fetch/orders', 'Admin\OrderController@fetchOrders')->name('fetch.orders');
    Route::post('order/status', 'Admin\OrderController@filter')->name('order.status');
    Route::post('order/search', 'Admin\OrderController@search')->name('order.search');
    Route::post('order/store', 'Admin\OrderController@selectStore')->name('order.store');
    Route::post('order/getdetail', 'Admin\OrderController@getDetail')->name('order.detail');
    Route::post('order/changestaus', 'Admin\OrderController@changeStatus')->name('order.changestatus');
    Route::resource('products','Admin\ProductController');
    Route::post('fetch/products', 'Admin\ProductController@fetchProducts')->name('fetch.products');
    Route::post('product/store', 'Admin\ProductController@selectStore')->name('product.store');
    Route::resource('settings','Admin\SettingController')->middleware('checkRole');
    Route::resource('users', 'Admin\addUserController');
    Route::resource('stores', 'Admin\ShopController');
    Route::resource('store-settings', 'Admin\StoreSettingController');
    Route::resource('ordernotes', 'Admin\OrderNoteController');
    Route::resource('questions', 'Admin\QuestionController');
    Route::post('add/tracking/info','Admin\OrderController@createTrackingInfo')->name('add.tracking.info');
    Route::get('addconsignment/{id}','Admin\OrderController@addConsignment')->name('add.consignment');
    Route::get('courierorder','Admin\OrderController@addCourierOrder')->name('add.courier.order');
});