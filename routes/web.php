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

Route::get('/', function () {
    return view('welcome');
});

Route::any('info',function(){
	phpinfo();
}); 

Route::any('test/hello','Test\TestController@test');
Route::any('test/redis1','Test\TestController@redis1');
Route::any('test/guzzle1','Test\TestController@guzzle1');
Route::any('test/adduser','User\LoginController@addUser');

Route::get('/test/baidu','Test\TestController@baidu');

// 微信开发

Route::get('weixin/index','Wechat\WechatController@checkSignature');
Route::post('weixin/index','Wechat\WechatController@receiv');         //接收微信的推送事件
