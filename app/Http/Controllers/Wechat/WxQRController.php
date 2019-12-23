<?php

namespace App\Http\Controllers\Wechat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\WxUserModel;
use GuzzleHttp\Client;

class WxQRController extends Controller
{

    public function qrcode()
    {
    	$scene_id = $_GET['scene'];	//二维码参数
    	$access_token = WxUserModel::getAccessToken();
    	//第一 获取ticket
    	$url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?ticket='.$access_token;

    	$data1 = [
    		'expire_seconds'	=> 604800,
    		'action_name'		=> 'QR_SCENE',
    		'access_info'		=> [
    			'scene' => [
    				'scene_id' => $scene_id
    			]
    		]
    	];

    	$client = new Client();
    	$response = $client->Request('POST',$url,[
    		'body' => json_encode($data1)
    	]);

    	$json1 = $response->getBody();
    	$tiket = json_decode($json1,true)['ticket'];

    	//第二 获取带参数的二维码
    	$url = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$tiket;
    	return redirect($url);

    }

}
