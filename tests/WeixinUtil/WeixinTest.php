<?php
/**
 * Created by PhpStorm.
 * User: pmsl
 * Date: 17-4-18
 * Time: 下午10:04
 * 用途:
 */

namespace app\weixin\controller;


use extra\WeixinCustomerService;
use extra\WeixinMaterial;
use extra\WeixinMenu;
use extra\WeixinQrcode;
use extra\WeixinUserGroup;
use extra\CryptOperation;
use think\Session;

class WeixinTest {
    public function test(){
//        MCRYPT_MODE_ECB模式不使用mcrypt_create_iv()创建的随机初始向量,所以重复加密都是相同的值
        $aes=new CryptOperation(MCRYPT_RIJNDAEL_128,MCRYPT_MODE_ECB);
//        其他模式使用mcrypt_create_iv()创建的随机初始向量,所以重复加密都是不相同的值
//        $aes=new AesOperation(MCRYPT_BLOWFISH,MCRYPT_MODE_CBC);
        $plain_text=$aes->encrypt('abc','123456789');
        var_dump($plain_text);
        var_dump($aes->decrypt('abc',$plain_text));
        exit();
//        var_dump(getCodeUrl('http://pmsl.natapp1.cc/index.php/weixin/redirect','snsapi_userinfo','ope'));
//        exit();
        $re1=getCodeUrl('http://pmsl.natapp1.cc/index.php/weixin/redirect','snsapi_base','ope');
        write_file("re1.txt", $re1);
        $re2=getCodeUrl('http://pmsl.natapp1.cc/index.php/weixin/redirect','snsapi_userinfo','ope');
        write_file("re2.txt", $re2);
        $create_menu=new WeixinMenu();
        $button1=array();
        $button1['type']='click';
        $button1['name']='今日歌曲';
        $button1['key']='V1001_TODAY_MUSIC';
        $button2=array();
        $button2['name']='菜单';
        $button2['sub_button']=array(array('type'=>"view","name"=>"snsapi_base","url"=>$re1),array("type"=>"view", "name"=>"snsapi_userinfo", "url"=>$re2));
        $create_menu->createMenu(array($button1,$button2));




//        if ($_FILES["file"]["error"] > 0)
//        {
//            echo "Error: " . $_FILES["file"]["error"] . "<br />";
//        }
//        else
//        {
//            echo "Upload: " . $_FILES["file"]["name"] . "<br />";
//            echo "Type: " . $_FILES["file"]["type"] . "<br />";
//            echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
//            echo "Stored in: " . $_FILES["file"]["tmp_name"];
//            var_dump($_POST);
//            var_dump($_FILES);
//            write_file('postForm', $_FILES["file"]["name"]."\n".$_FILES["file"]["type"]."\n".$_FILES["file"]["size"]."\n".$_FILES["file"]["tmp_name"]);
//        }
//        exit();


    }

}