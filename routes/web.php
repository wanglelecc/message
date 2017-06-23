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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::auth();
Route::get('/', function(){
    return view('welcome');
});
Auth::routes();


Route::group([
//    'prefix' => 'admin',
//    'namespace' => 'Admin',
    'middleware' => ['auth'],
    ], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/wechat', 'WechatController@index')->name('wechat');
    Route::get('/wechat/message', 'WechatController@message');
    Route::get('/wechat/message2', 'WechatController@message2');
});

Route::any('/wechat', 'WechatController@serve');