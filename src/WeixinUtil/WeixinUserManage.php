<?php
/**
 * Created by PhpStorm.
 * User: pmsl
 * Date: 17-4-30
 * Time: 下午7:47
 * 用途:
 */
namespace WeixinUtil;

use \think\Session;

class WeixinUserManage
{

    /**
     * 设置备注名
     * @param $openid string openid
     * @param $remark string 备注名
     */
    public function setRemarkName($openid, $remark)
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/user/info/updateremark?access_token=" . $access_token;
            $http_client = new HttpClient();
            $result = $http_client->send($url, 'POST', json_encode(array("openid"=>$openid,"remark"=>$remark), JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
            var_dump($result);
        } else {
            getAccessToken();
            $this->setRemarkName($openid, $remark);
        }
    }


    public function getUserInfo($openid)
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$access_token}&openid={$openid}&lang=zh_CN";
            $http_client = new HttpClient();
            $result = $http_client->send($url, 'GET');
            var_dump($result);
            $result_array = json_decode($result, true);
            var_dump($result_array);
        } else {
            getAccessToken();
            $this->getUserInfo($openid);
        }
    }
    public function batchGetUserInfo($data)
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/user/info/batchget?access_token=".$access_token;
            $http_client = new HttpClient();
            $result = $http_client->send($url, 'POST', json_encode($data, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
            var_dump($result);
//            $result_array = json_decode($result, true);
//            var_dump($result_array);
        } else {
            getAccessToken();
            $this->batchGetUserInfo($data);
        }
    }
    public function getFocusUserList($next_openid)
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token={$access_token}&next_openid={$next_openid}";
            $http_client = new HttpClient();
            $result = $http_client->send($url, 'GET');
            var_dump($result);
        } else {
            getAccessToken();
            $this->getFocusUserList($next_openid);
        }
    }
}
