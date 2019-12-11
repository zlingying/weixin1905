<?php

namespace App\Http\Controllers\Wechat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WechatController extends Controller
{
    public function checkSignature()
	{
        /**
         * 处理接入请求
         */
		$token = '2259b56f5898cd6192c50';    //开发提前设置好的 token
	    $signature = $_GET["signature"];
	    $timestamp = $_GET["timestamp"];
	    $nonce = $_GET["nonce"];
		$echostr = $_GET['echostr'];

	    $tmpArr = array($token, $timestamp, $nonce);
	    sort($tmpArr, SORT_STRING);
	    $tmpStr = implode( $tmpArr );
	    $tmpStr = sha1( $tmpStr );

	    if( $tmpStr == $signature ){       //验证通过
	        echo $echostr;
	    }else{
	        die('Not OK!');
	    }
	}


    /**
     * 获取用户基本信息
     */
    public function getUserInfo()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=ACCESS_TOKEN&openid=OPENID&lang=zh_CN";
    }
    /**
     * 接收微信推送事件
     */
	public function receiv()
    {
        $log_file = "wx.log";   //public
        //将接受的数据记录到日志文件中
        $xml_str = file_get_contents("php://input");
        $data = date('Y-m-d H:i:s') . $xml_str;
        file_put_contents($log_file,$data,FILE_APPEND);     //追加写入

    //处理xml数据
    file_put_contents('xml.log',$xml_str);
    $xml_obj = simplexml_load_string($xml_str);


    //判断消息类型
    $msg_type = $xml_obj->MsgType;

    $touser = $xml_obj->FromUserName;   //接收消息的用户openid
    $fromuser = $xml_obj->ToUserName;   //开发者公众号的id
    $time = time();

      if($msg_type=='text'){
            $content = date('Y-m-d H:i:s') . $xml_obj->Content;
            $response_text = '<xml>
  <ToUserName><![CDATA['.$touser.']]></ToUserName>
  <FromUserName><![CDATA['.$fromuser.']]></FromUserName>
  <CreateTime>'.$time.'</CreateTime>
  <MsgType><![CDATA[text]]></MsgType>
  <Content><![CDATA['.$content.']]></Content>
</xml>';
            echo $response_text;            // 回复用户消息
        }
    }
}
