<?php

namespace App\Admin\Controllers;

use App\Model\WxUserModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use GuzzleHttp\Client;

class WxMsgController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '微信用户管理';

    public function sendMsg()
    {
    	echo __METHOD__;

    	$openid_arr = WxUserModel::select('openid','nickname','sex')->get()->toArray();
    	//echo '<pre>';print_r($openid_arr);echo '</pre>';
    	$openid = array_column($openid_arr,'openid');
    	echo '<pre>';print_r($openid);echo '</pre>';

    	$url = 'https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=28_ZOIFpb30lh2cJcFi-GDHt8svDsNMkWyqAPeYkXwEWfTIq0U1NDrqvPL4DhL5Yt8ZZR-H5T_9DoEW8jHUfGMjQGBIYRVCNk5Vzb_IUwwhQK3-50tlEK-FBzMbsv8uM5O6pK9QVBFIDn702Z3MVHAeACAIUN';

    	$msg = date('Y-m-d H:i:s') . '愿你好运！！！';

    	$data = [
    		'touser'   => $openid,
    		'msgtype'  => 'text',
    		'text'     => ['content'=>$msg]
    	];

    	$client = new Client();
    	$response = $client->request('POST',$url,[
    		'body' => json_encode($data,JSON_UNESCAPED_UNICODE)
    	]);

    	echo $response->getBody();
    }
    
}
