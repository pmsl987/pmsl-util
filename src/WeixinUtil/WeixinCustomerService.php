<?php
/**
 * Created by PhpStorm.
 * User: pmsl
 * Date: 17-4-28
 * Time: 下午11:23
 * 用途:
 */
namespace WeixinUtil;

use PmslUtil\HttpClient;

class WeixinCustomerService
{

    /**
     *
     * @param $data
     * 示例：
     *  $customer=new WeixinCustomerService();
     *  $customer->addCustomer(array("kf_account"=>"test1@test","nickname"=>"客服1","password"=>"pswmd5"));
    }
     */
    public function addCustomer($data)
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/customservice/kfaccount/add?access_token=" . $access_token;
            $http_client = new HttpClient();
//            var_dump(json_encode($data, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
//            exit();
            $result = $http_client->send($url, 'POST', json_encode($data, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES), '');
            var_dump($result);
        } else {
            getAccessToken();
        }
    }
    public function updateCustomer($data)
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/customservice/kfaccount/update?access_token=" . $access_token;
            $http_client = new HttpClient();
            $result = $http_client->send($url, 'POST', json_encode($data, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES), '');
            var_dump($result);
        } else {
            getAccessToken();
        }
    }
    public function deleteCustomer($data)
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/customservice/kfaccount/del?access_token=" . $access_token;
            $http_client = new HttpClient();
            $result = $http_client->send($url, 'GET', '', '');
            var_dump($result);
        } else {
            getAccessToken();
        }
    }

    public function getAllCustomer()
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/customservice/getkflist?access_token=" . $access_token;
            $http_client = new HttpClient();
            $result = $http_client->send($url, 'GET', '', '');
            var_dump($result);
        } else {
            getAccessToken();
        }
    }

    public function setHeadImage($data, $kfaccount)
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "http://api.weixin.qq.com/customservice/kfaccount/uploadheadimg?access_token=". $access_token."&kf_account=".$kfaccount ;
            $http_client = new HttpClient();
            $result = $http_client->send($url, 'POST', json_encode($data, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES), '');
            var_dump($result);
        } else {
            getAccessToken();
        }
    }

    public function sendMessage($data)
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=" . $access_token;
            $http_client = new HttpClient();
            $result = $http_client->send($url, 'POST', json_encode($data, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES), '');
            var_dump($result);
        } else {
            getAccessToken();
        }
    }
}
