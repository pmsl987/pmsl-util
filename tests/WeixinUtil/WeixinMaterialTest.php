<?php
/**
 * Created by PhpStorm.
 * User: pmsl
 * Date: 17-4-30
 * Time: 下午3:32
 * 用途:
 */

namespace app\weixin\controller;


class WeixinMaterialTest {
    public function test(){

//        新增临时素材
//        $weixinMaterial=new WeixinMaterial();
//        $path = realpath(__DIR__ . '/../../../public/img/2.jpg');
//        $weixinMaterial->addTempMaterial('image',$path);

//        获取临时素材
//        $weixinMaterial=new WeixinMaterial();
//        $weixinMaterial->getTempMaterial('XRQFR_KWLb-nTbH5MHF2QZbGJxZCyGi0emaKvNXwkwOkDq-1wvR-0a38a8GR6jSj');

//        上传图文消息内的图片获取URL
//        $weixinMaterial=new WeixinMaterial();
//        $path = realpath(__DIR__ . '/../../../public/img/2.jpg');
//        $weixinMaterial->getImgTextUrl('image',$path);

//        新增永久素材
//        $weixinMaterial=new WeixinMaterial();
//        $path = realpath(__DIR__ . '/../../../public/img/2.jpg');
//        $weixinMaterial->addForeverMaterial('image',$path);

//        新增永久图文素材
//        $weixinMaterial = new WeixinMaterial();
//        $weixinMaterial->addImageTextForeverMaterial(array(array(
//            "title" => "图文永久素材",
//            "thumb_media_id" => "hZuFqff66-SQXokFPEAPr8MzjYTUE0LSwP6CjT-Tw5M",
//            "author" => "pmsl",
//            "digest" => "pmsl测试",
//            "show_cover_pic" => 1,
//            "content" => "pmsl测试内容测试内容测试内容测试内容测试内容测试内容测试内容测试内容",
//            "content_source_url" => "www.baidu.com"
//        )));
//
//        修改永久图文素材
        $weixinMaterial = new WeixinMaterial();
        $weixinMaterial->updateImageTextForeverMaterial('hZuFqff66-SQXokFPEAPr5rilCsL8mF7Ln6096VBDr0',0,array(
            "title" => "图文永久素材",
            "thumb_media_id" => "hZuFqff66-SQXokFPEAPr8MzjYTUE0LSwP6CjT-Tw5M",
            "author" => "pmsl",
            "digest" => "pmsl测试",
            "show_cover_pic" => 1,
            "content" => "pmsl测试内容测试内容测试内容测试内容测试内容测试内容测试内容测试内容",
            "content_source_url" => "www.baidu.com"
        ));


//        获取永久素材
//        $weixinMaterial=new WeixinMaterial();
//        $weixinMaterial->getForeverMaterial('hZuFqff66-SQXokFPEAPr_VxbydU79KPEjSAx1lOlhs');

//        删除永久素材
//        $weixinMaterial=new WeixinMaterial();
//        $weixinMaterial->deleteForeverMaterial('hZuFqff66-SQXokFPEAPr_VxbydU79KPEjSAx1lOlhs');

//        获取素材总数
//        $weixinMaterial=new WeixinMaterial();
//        $weixinMaterial->getForeverMaterialCount();

//        获取素材列表
//        $weixinMaterial=new WeixinMaterial();
//        $weixinMaterial->getForeverMaterialList('image',0,1);


//        新增永久素材
//        $weixinMaterial=new WeixinMaterial();
//
//        $weixinMaterial->addForeverMaterial(array(array(
//            "title"=> "TITLE",
//            "thumb_media_id"=> "THUMB_MEDIA_ID",
//            "author"=> "AUTHOR",
//            "digest"=> "DIGEST",
//            "show_cover_pic"=> "SHOW_COVER_PIC(0 / 1)",
//            "content"=> "CONTENT",
//            "content_source_url"=> "CONTENT_SOURCE_URL")));

    }

}