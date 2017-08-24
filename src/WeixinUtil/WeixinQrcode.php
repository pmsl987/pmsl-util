<?php

/**
 * Created by PhpStorm.
 * User: pmsl
 * Date: 17-4-30
 * Time: 下午8:13
 * 用途:
 */
namespace WeixinUtil;

use \think\Session;

class WeixinQrcode
{
    /**
     * 创建二维码
     * @param $data
     */
    public function createQrcode($data)
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$access_token;
            $http_client = new HttpClient();
            $result = $http_client->send($url, 'POST', json_encode($data, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
            var_dump($result);
//            $result_array = json_decode($result, true);
//            var_dump($result_array);
        } else {
            getAccessToken();
            $this->createQrcode($data);
        }
    }

    /**
     * 通过ticket获取二维码
     * @param $ticket
     */
    public function getQrcodeWithTicket($ticket)
    {
        $ticket=urlencode($ticket);
        $url = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket={$ticket}";
        $http_client = new HttpClient();
        $result = $http_client->send($url, 'GET');
        var_dump($result);
    }

    /**
     * 长url转换城短url
     * @param $long_url string 长url
     */
    public function long2shortUrl($long_url)
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/shorturl?access_token=".$access_token;
            $http_client = new HttpClient();
            $data['action']="long2short";
            $data['long_url']=$long_url;
            $result = $http_client->send($url, 'POST', $data);
            var_dump($result);
//            $result_array = json_decode($result, true);
//            var_dump($result_array);
        } else {
            getAccessToken();
            $this->long2shortUrl($long_url);
        }
    }
}
