<?php


namespace WeixinUtil;

use PmslUtil\HttpClient;

class WeixinMenu
{
    /**
     * 创建菜单
     * 使用示例：
     *   $create_menu=new WeixinMenu();
     *   $button1=array();
     *   $button1['type']='click';
     *   $button1['name']='今日歌曲';
     *   $button1['key']='V1001_TODAY_MUSIC';
     *   $button2=array();
     *   $button2['name']='菜单';
     *   $button2['sub_button']=array(array('type'=>"view","name"=>"搜索","url"=>"http://www.soso.com/"),array("type"=>"view", "name"=>"视频", "url"=>"http://v.qq.com/"));
     *   $create_menu->createMenu(array($button1,$button2));
     */
    public function createMenu($arg)
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=" . $access_token;
            $http_client = new HttpClient();
//          获取传入的参数
//            $arg = func_get_args();
            $menu = array();
            foreach ($arg as $value) {
                $menu['button'][] = $value;
            }
//            var_dump(json_encode($menu, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
//            exit;
            $result = $http_client->send($url, 'POST', json_encode($menu, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES), '');
            if ($result==false) {
                if (!empty($_SESSION['createMenuNum'])) {
                    $createMenuNum = $_SESSION['access_token'];
                    if ($createMenuNum<4) {
                        $_SESSION['createMenuNum']=$createMenuNum+1;
                        $this->createMenu($arg);
                    } else {
                        echo "ERROR:操作超过3次";
                        unset($_SESSION['createMenuNum']);
                    }
                } else {
                    $_SESSION['createMenuNum']=1;
                    $this->createMenu($arg);
                }
            } else {
                var_dump($result);
            }
        } else {
            getAccessToken();
//            没有传入的参数
            $this->createMenu($arg);
        }
    }


    /**
     * 创建个性化菜单
     * 使用示例：
     *   $create_conditional_menu=new WeixinMenu();
     *   $button1=array();
     *   $button1['type']='click';
     *   $button1['name']='今日歌曲';
     *   $button1['key']='V1001_TODAY_MUSIC';
     *   $button2=array();
     *   $button2['name']='菜单';
     *   $button2['sub_button']=array(array('type'=>"view","name"=>"搜索","url"=>"http://www.soso.com/"),array("type"=>"view", "name"=>"视频", "url"=>"http://v.qq.com/"));
     *   $matchrule=array("group_id"=>"2", "country"=>"中国", "province"=>"广东", "city"=>"广州", "client_platform_type"=>"2","language"=>"zh_CN");
     *   $create_menu->createMenu(array($button1,$button2),$matchrule);
     */
    public function createConditionalMenu($button, $matchrule)
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/menu/addconditional?access_token=" . $access_token;
            $http_client = new HttpClient();
            $menu = array();
            foreach ($button as $value) {
                //                foreach ($value as $val){
                $menu['button'][] = $value;
//                }
            }
            $menu['matchrule']=$matchrule;
//            var_dump(json_encode($menu, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
//            exit;
            $result = $http_client->send($url, 'POST', json_encode($menu, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES), '');
            var_dump($result);
        } else {
            getAccessToken();
            $this->createConditionalMenu($button, $matchrule);
        }
    }

    /**
     * 查询菜单
     * 使用示例：
     *   $query_menu=new WeixinMenu();
     *   $query_menu->queryMenu();
     */
    public function queryMenu()
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/menu/get?access_token=" . $access_token;
            $http_client = new HttpClient();
            $result = $http_client->send($url, 'GET');
            dump(stripslashes($result));
            dump(json_decode(stripslashes($result), true));
        } else {
            getAccessToken();
            $this->queryMenu();
        }
    }
    /**
     * 删除菜单
     * 使用示例：
     *   $query_menu=new WeixinMenu();
     *   $query_menu->deleteMenu();
     */
    public function deleteMenu()
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=" . $access_token;
            $http_client = new HttpClient();
            $result = $http_client->send($url, 'GET');
            var_dump(stripslashes($result));
        } else {
            getAccessToken();
            $this->deleteMenu();
        }
    }

    /**
     * 删除个性化菜单
     * 使用示例：
     *   $query_menu=new WeixinMenu();
     *   $query_menu->deleteConditionalMenu();
     */
    public function deleteConditionalMenu()
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/menu/delconditional?access_token=" . $access_token;
            $http_client = new HttpClient();
            $result = $http_client->send($url, 'GET');
            var_dump(stripslashes($result));
        } else {
            getAccessToken();
            $this->deleteConditionalMenu();
        }
    }

    /**
     * 测试个性化菜单匹配结果
     * 使用示例：
     *   $query_menu=new WeixinMenu();
     *   $data=array('user_id'=>'微信号或open_id');
     *   $query_menu->tryConditionalMenu($data);
     */

    public function tryConditionalMenu($data)
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/menu/trymatch?access_token=" . $access_token;
            $http_client = new HttpClient();
            $result = $http_client->send($url, 'POST', json_encode($data), '');
            var_dump(stripslashes($result));
        } else {
            getAccessToken();
            $this->tryConditionalMenu($data);
        }
    }


    /**
     * 查询接口菜单配置
     * 使用示例：
     *   $query_menu=new WeixinMenu();
     *   $query_menu->getApiMenuConfigure();
     */
    public function getApiMenuConfigure()
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/get_current_selfmenu_info?access_token=" . $access_token;
            $http_client = new HttpClient();
            $result = $http_client->send($url, 'GET');
            var_dump(stripslashes($result));
        } else {
            getAccessToken();
            $this->getApiMenuConfigure();
        }
    }
}
