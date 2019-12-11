<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function addUser()
    {
    	$pwd = "123";
    	// 使用密码函数
    	$password = password_hash($pwd,PASSWORD_BCRYPT);
    	$email = "877673916@qq.com";
    	$user_name = Str::random(8);

    	$data = [
    		'user_name' => $user_name,
    		"password" => $password,
    		'email' => $email,
    	];

    	$uid = UserModel::insertGetId($data);
    	dd($uid);
    }
}
