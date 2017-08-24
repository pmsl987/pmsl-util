<?php
/**
 * Created by PhpStorm.
 * User: pmsl
 * Date: 17-4-29
 * Time: 下午4:02
 * 用途:
 */
namespace WeixinUtil;

use PmslUtil\HttpClient;

class WeixinMaterial
{

    /**
     *
     * @param $type string 资源类型
     * @param $path string 资源文件路径
     * 示例：
     *  $weixinMaterial=new WeixinMaterial();
     *  $path = realpath(__DIR__ . '/../../../public/img/2.jpg');
     *  $weixinMaterial->addTempMaterial('image',$path);
     */
    public function addTempMaterial($type, $path)
    {
        //上传的临时多媒体文件有格式和大小限制，如下：
//图片（image）: 2M，支持bmp/png/jpeg/jpg/gif格式
//语音（voice）：2M，播放长度不超过60s，支持AMR\MP3格式
//视频（video）：10MB，支持MP4格式
//缩略图（thumb）：64KB，支持JPG格式
//媒体文件在后台保存时间为3天，即3天后media_id失效。

//需使用/开启https调用本接口。
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token=" . $access_token . "&type=" . $type;
            $http_client = new HttpClient();
            $result = $http_client->uploadFile($url, array('name' => 'media', 'path' => $path));
            var_dump($result);
        } else {
            getAccessToken();
            $this->addTempMaterial($type, $path);
        }
    }

    /**
     *
     * @param $media_id string 素材的media_id
     * 示例：
     * $weixinMaterial=new WeixinMaterial();
     * $weixinMaterial->getTempMaterial('XRQFR_KWLb-nTbH5MHF2QZbGJxZCyGi0emaKvNXwkwOkDq-1wvR-0a38a8GR6jSj');
     */
    public function getTempMaterial($media_id)
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/media/get?access_token=" . $access_token . "&media_id=" . $media_id;
            $http_client = new HttpClient();
            $result = $http_client->send($url, 'GET', '', true);
            var_dump($result);
        } else {
            getAccessToken();
            $this->getTempMaterial($media_id);
        }
    }

    /**
     *
     * @param $type string 资源类型
     * @param $path string 资源文件路径
     * 示例:
     * //        新增永久素材
     *  $weixinMaterial=new WeixinMaterial();
     *  $path = realpath(__DIR__ . '/../../../public/img/2.jpg');
     *  $weixinMaterial->addForeverMaterial('image',$path);
     */
    public function addForeverMaterial($type, $path)
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=" . $access_token;
            $http_client = new HttpClient();
            $result = $http_client->uploadFile($url, array('name' => 'media', 'path' => $path));
            var_dump(stripslashes($result));
        } else {
            getAccessToken();
            $this->addForeverMaterial($type, $path);
        }
    }

    /**
     *
     * @param $arg
     * 示例:
     *  $weixinMaterial = new WeixinMaterial();
     *  $weixinMaterial->addImageTextForeverMaterial(array(array(
     *   "title" => "图文永久素材",
     *   "thumb_media_id" => "hZuFqff66-SQXokFPEAPr8MzjYTUE0LSwP6CjT-Tw5M",
     *   "author" => "pmsl",
     *   "digest" => "pmsl测试",
     *   "show_cover_pic" => 1,
     *   "content" => "pmsl测试内容测试内容测试内容测试内容测试内容测试内容测试内容测试内容",
     *   "content_source_url" => "www.baidu.com"
     *  )));
     */
    public function addImageTextForeverMaterial($arg)
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=" . $access_token;
            $articles = array();
            foreach ($arg as $value) {
                $articles['articles'][] = $value;
            }
//            var_dump(json_encode($articles, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
//            exit();
//            hZuFqff66-SQXokFPEAPr5rilCsL8mF7Ln6096VBDr0
            $http_client = new HttpClient();
            $result = $http_client->send($url, 'POST', json_encode($articles, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
            var_dump(stripslashes($result));
        } else {
            getAccessToken();
            $this->addImageTextForeverMaterial($arg);
        }
    }


    /**
     * @param $media_id
     * @param $index
     * @param $arg
     * 示例:
     * //        修改永久图文素材
     * $weixinMaterial = new WeixinMaterial();
     * $weixinMaterial->updateImageTextForeverMaterial('hZuFqff66-SQXokFPEAPr5rilCsL8mF7Ln6096VBDr0',0,array(
     * "title" => "图文永久素材",
     * "thumb_media_id" => "hZuFqff66-SQXokFPEAPr8MzjYTUE0LSwP6CjT-Tw5M",
     * "author" => "pmsl",
     * "digest" => "pmsl测试",
     * "show_cover_pic" => 1,
     * "content" => "pmsl测试内容测试内容测试内容测试内容测试内容测试内容测试内容测试内容",
     * "content_source_url" => "www.baidu.com"
     * ));
     */
    public function updateImageTextForeverMaterial($media_id, $index, $arg)
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/material/update_news?access_token=" . $access_token;
            $articles = array();
            $articles['media_id']=$media_id;
            $articles['index']=$index;
            $articles['articles'] = $arg;
//            var_dump(json_encode($articles, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
//            exit();
            $http_client = new HttpClient();
            $result = $http_client->send($url, 'POST', json_encode($articles, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
            var_dump(stripslashes($result));
        } else {
            getAccessToken();
            $this->updateImageTextForeverMaterial($media_id, $index, $arg);
        }
    }



    /**
     *
     * @param $media_id string 素材的media_id
     * 示例:
     * //        获取永久素材
     * $weixinMaterial=new WeixinMaterial();
     * $weixinMaterial->getTempMaterial('hZuFqff66-SQXokFPEAPr3wSKNX2SnykmIohny7wmt0');
     */
    public function getForeverMaterial($media_id)
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/material/get_material?access_token=" . $access_token;
            $http_client = new HttpClient();
            $result = $http_client->send($url, 'POST', json_encode(array('media_id'=>$media_id), JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
//            将数据流保存为图片
//            file_put_contents('test.jpg', $result);
            var_dump($result);
        } else {
            getAccessToken();
            $this->getForeverMaterial($media_id);
        }
    }

    /**
     *
     * @param $media_id
     * 示例:
     *
     * //        删除永久素材
     * $weixinMaterial=new WeixinMaterial();
     * $weixinMaterial->deleteForeverMaterial('hZuFqff66-SQXokFPEAPr_VxbydU79KPEjSAx1lOlhs');
     */
    public function deleteForeverMaterial($media_id)
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/material/del_material?access_token=" . $access_token;
            $http_client = new HttpClient();
            $result = $http_client->send($url, 'POST', json_encode(array('media_id'=>$media_id), JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
//            将数据流保存为图片
//            file_put_contents('test.jpg', $result);
            var_dump($result);
        } else {
            getAccessToken();
            $this->deleteForeverMaterial($media_id);
        }
    }


    /**
     * 示例：
     * //        获取素材总数
     * $weixinMaterial=new WeixinMaterial();
     * $weixinMaterial->getForeverMaterialCount();
     */
    public function getForeverMaterialCount()
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/material/get_materialcount?access_token=" . $access_token;
            $http_client = new HttpClient();
            $result = $http_client->send($url, 'GET');
            var_dump($result);
        } else {
            getAccessToken();
            $this->getForeverMaterialCount();
        }
    }

    /**
     *
     * @param $type string 素材的类型，图片（image）、视频（video）、语音 （voice）、图文（news）
     * @param $offset int 从全部素材的该偏移位置开始返回，0表示从第一个素材 返回
     * @param $count int 返回素材的数量，取值在1到20之间
     * 示例：
     * //        获取素材列表
     *  $weixinMaterial=new WeixinMaterial();
     *  $weixinMaterial->getForeverMaterialList('image',0,1);
     */
    public function getForeverMaterialList($type, $offset, $count)
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=" . $access_token;
            $http_client = new HttpClient();
            $result = $http_client->send($url, 'POST', json_encode(array('type'=>$type,'offset'=>$offset,'count'=>$count), JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
            var_dump(stripslashes($result));
        } else {
            getAccessToken();
            $this->getForeverMaterialCount();
        }
    }



    /**
     * 上传图文消息内的图片并获取URL
     * @param $type
     * @param $path
     * 示例：
     * //        上传图文消息内的图片获取URL
     *   $weixinMaterial=new WeixinMaterial();
     *   $path = realpath(__DIR__ . '/../../../public/img/2.jpg');
     *   $weixinMaterial->getImgTextUrl('image',$path);
     */
    public function getImgTextUrl($type, $path)
    {
        if (isValidAccessToken()) {
            $access_token = $_SESSION['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/media/uploadimg?access_token=" . $access_token;
            $http_client = new HttpClient();
            $result = $http_client->uploadFile($url, array('name' => 'media', 'path' => $path));
            var_dump(stripslashes($result));
        } else {
            getAccessToken();
            $this->getImgTextUrl($type, $path);
        }
    }
}
