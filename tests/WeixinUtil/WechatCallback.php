<?php
/**
 * Created by PhpStorm.
 * User: pmsl
 * Date: 17-4-18
 * Time: 下午12:28
 */

namespace app\weixin\controller;

use PmslUtil\RequestUtil;
use WeixinUtil\WechatCallbackApi;
use WeixinUtil\WeixinMessage;
class WechatCallback {
    public function callback(){

        if (RequestUtil::isGet()) {
            $wechatObj = new WechatCallbackApi();
            $wechatObj->valid();
        } else if (RequestUtil::isPost()) {
            $wechatObj = new WeixinMessage();
            $wechatObj->parseMessage();

        } else {

        }
    }
//    // 获取网页信息的回调url
    public function redirect(){
        if (RequestUtil::isGet() && !empty('code')) {
            $code = $_GET['code'];
//            exit();
//            如果为snsapi_base，则getWebAccessToken方法之后就结束了
            $token_array=getWebAccessToken($code);
            if($token_array==false){
                $token_array=getWebAccessToken($code);
            }
            var_dump($token_array);
            $access_token = $token_array['access_token'];
            $openid = $token_array['openid'];
//            $scope = Session::get('scope');
//            var_dump($_SESSION);
            $scope = $token_array['scope'];
            if ($scope == "snsapi_userinfo") {
                $result_array = getUserInfo($access_token, $openid);
                if ($result_array == false) {
                    $result_array = getUserInfo($access_token, $openid);
                }
                var_dump($result_array);
            } else {

            }


        } else {

        }

    }

}