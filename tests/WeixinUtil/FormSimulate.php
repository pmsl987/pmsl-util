<?php
/**
 * Created by PhpStorm.
 * User: pmsl
 * Date: 17-4-29
 * Time: 下午4:15
 * 用途:
 */

require_once __DIR__ . '/../../vendor/autoload.php'; // Autoload files using Composer autoload

use CURLFile;
use PmslUtil\HttpClient;

function postSimulate(){
//        物理绝对路径
//        /home/pmsl/PhpstormProjects/thinkphp/weixin-tp/public/img/1.jpg
    $media = realpath(__DIR__ . '/../../../public/img/1.jpg');
    $ch = curl_init("http://pmsl.tp/weixin-tp/index.php/weixin/test");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $args['file'] = new CurlFile($media);
//        第一个参数为，第二个参数为Mine-type，第三个post的名字，
//        等价于与 $args['file'] = new CurlFile($media);
//        $args['file'] = curl_file_create($media, 'image/png', $media);
//        $args['md'] = 'md';
    $args = json_encode(array('type' => 'image', 'offset' => 2, 'count' => 3, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
    $result = curl_exec($ch);
//        输出http://pmsl.tp/weixin-tp/index.php/weixin/test脚本输出的内容
    echo $result;
}

postSimulate();
