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

Route::get('/info',function(){
	phpinfo();
}); 

Route::get('test/hello','Test\TestController@test');
Route::get('test/redis1','Test\TestController@redis1');
Route::get('test/guzzle1','Test\TestController@guzzle1');
Route::get('test/adduser','User\LoginController@addUser');
Route::get('test/xml','Test\TestController@xmlTest');

Route::get('test/baidu','Test\TestController@baidu');

// 微信开发

Route::get('weixin/test','Wechat\WechatController@test');
Route::get('weixin/index','Wechat\WechatController@checkSignature');//处理接入请求
Route::post('weixin/index','Wechat\WechatController@receiv');         //接收微信的推送事件
Route::get('weixin/media','Wechat\WechatController@getMedia');         //获取临时素材
Route::get('/weixin/flush/access_token','Wechat\WechatController@flushAccessToken');        //刷新access_token
