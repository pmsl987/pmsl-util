<?php

/**
 * Created by PhpStorm.
 * User: pmsl
 * Date: 17-4-30
 * Time: 下午3:31
 * 用途:
 */
namespace WeixinUtil;

use \think\Session;

class WeixinUserGroup
{

    /**
     * 创建分组
     * @param $data
     * 示例:
     * $weixinUserGroup=new WeixinUserGroup();
     * $weixinUserGroup->createGroup(array("group"=>array("name"=>"test")));
     */
    public function createGroup($data)
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/groups/create?access_token=" . $access_token;
            $http_client = new HttpClient();
            $result = $http_client->send($url, 'POST', json_encode($data, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES), '');
            var_dump($result);
        } else {
            getAccessToken();
            $this->createGroup($data);
        }
    }

    /**
     * 获取所有分组
     *  $weixinUserGroup=new WeixinUserGroup();
     *  $weixinUserGroup->getAllGroup();
     */
    public function getAllGroup()
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/groups/get?access_token=" . $access_token;
            $http_client = new HttpClient();
            $result = $http_client->send($url, 'GET');
            var_dump($result);
        } else {
            getAccessToken();
            $this->getAllGroup();
        }
    }

    /**
     * 查询openid所在分组
     * @param $open_id
     * 示例:
     * $weixinUserGroup=new WeixinUserGroup();
     * $weixinUserGroup->queryGroup('oQ88RxL5ge_gzJTEdyWTlNmh7CFo');
     */
    public function queryGroup($open_id)
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/groups/getid?access_token=" . $access_token;
            $http_client = new HttpClient();
            $result = $http_client->send($url, 'POST', json_encode(array('open_id'=>$open_id), JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES), '');
            var_dump($result);
        } else {
            getAccessToken();
            $this->queryGroup($open_id);
        }
    }


    /**
     * 修改分组
     * @param $data
     * 示例:
     * $weixinUserGroup=new WeixinUserGroup();
     * $weixinUserGroup->updateGroup(array("group"=>array("id"=>100,"name"=>"test1")));
     */
    public function updateGroup($data)
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/groups/update?access_token=" . $access_token;
            $http_client = new HttpClient();
            $result = $http_client->send($url, 'POST', json_encode($data, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES), '');
            var_dump($result);
        } else {
            getAccessToken();
            $this->updateGroup($data);
        }
    }

    /**
     * 移动分组
     * @param $data
     * 示例：
     *  $weixinUserGroup=new WeixinUserGroup();
     *  $weixinUserGroup->moveGroup(array("openid"=>'OPEN_ID',"to_groupid"=>"100"));
     */
    public function moveGroup($data)
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/groups/members/update?access_token=" . $access_token;
            $http_client = new HttpClient();
            $result = $http_client->send($url, 'POST', json_encode($data, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES), '');
            var_dump($result);
        } else {
            getAccessToken();
            $this->moveGroup($data);
        }
    }

    /**
     * 批量移动分组
     * @param $data
     * 示例：
     * $weixinUserGroup=new WeixinUserGroup();
     * $weixinUserGroup->batchMoveGroup(array("openid_list"=>array('OPEN_ID1','OPEN_ID2'),"to_groupid"=>"100"));
     */
    public function batchMoveGroup($data)
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/groups/members/batchupdate?access_token=" . $access_token;
            $http_client = new HttpClient();
            $result = $http_client->send($url, 'POST', json_encode($data, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES), '');
            var_dump($result);
        } else {
            getAccessToken();
            $this->batchMoveGroup($data);
        }
    }

    /**
     * 删除分组
     * @param $data
     * 示例:
     * $weixinUserGroup=new WeixinUserGroup();
     * $weixinUserGroup->deleteGroup(array("group"=>array("id"=>100)));
     */
    public function deleteGroup($data)
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/groups/delete?access_token=" . $access_token;
            $http_client = new HttpClient();
            $result = $http_client->send($url, 'POST', json_encode($data, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES), '');
            var_dump($result);
        } else {
            getAccessToken();
            $this->deleteGroup($data);
        }
    }
}
