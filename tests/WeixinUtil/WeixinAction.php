<?php
/**
 * Created by PhpStorm.
 * User: pmsl
 * Date: 17-4-18
 * Time: 下午2:21
 */

namespace app\weixin\controller;

use extra\HttpClient;
use think\Session;

class WeixinAction {


    /**
     * 获取微信服务器地址
     * @return mixed
     */
    public function getWeixinServerIP(){
        if (isValidAccessToken()) {
            $access_token=Session::get('access_token');
            $url="https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token=".$access_token;
            $http_client=new HttpClient();
            $result=$http_client->send($url,'GET','','');
            if(false!=$result){
                $result_array = json_decode($result, true);
                 var_dump($result_array['ip_list']);
//                获取每个ip地址
//                for($i=0;$i<count($result_array['ip_list']);$i++){
//                    echo $result_array['ip_list'][$i]."<br/>";
//                }

            }else{
                echo "获取微信服务器IP地址失败";
                exit;
            }

        } else {
            getAccessToken();

        }
    }


}