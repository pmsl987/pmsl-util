<?php

/**
 * Created by PhpStorm.
 * User: pmsl
 * Date: 17-4-18
 * Time: 下午2:24
 * 用途：http请求
 */

/**
 * Class HttpClient
 * 示例
 * $params="{user:\"admin\",pwd:\"admin\"}";
 * $headers=array('Content-type: text/json',"id: $ID","key:$Key");
 * $url=$GLOBALS["serviceUrl"]."/user";
 * $strResult= new HttpClient->send($url,"PUT",$params,$headers);
 */

namespace PmslUtil;

class HttpClient {

    /**
     * 发送请求
     * @param $url string 目标地址
     * @param $method string 请求方法
     * @param $params string 请求参数
     * @param $returnHeader boolean 要不要求返回响应头
     * @param $headers string 请求头
     * @param $timeout int 超时时间
     * @return mixed
     */
    public function send($url, $method, $params = '', $returnHeader = false, $headers = '', $timeout = 5){
        $curl = curl_init();
        //请求方法
        switch (strtoupper($method)) {
            case "GET":
                if (is_array($params)) {
                        $url.='?';
                    foreach ($params as $k=>$v){
                        $url.="{$k}={$v}&";
                    }
                    $url = substr($url, 0, strlen($url) - 1);
                    curl_setopt($curl, CURLOPT_URL, $url);//目标地址
                } else {
                    curl_setopt($curl, CURLOPT_URL, $url);//目标地址
                }
                curl_setopt($curl, CURLOPT_HTTPGET, true);
                break;
            case "POST":
                curl_setopt($curl, CURLOPT_URL, $url);//目标地址
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_URL, $url);//目标地址
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
                break;
            case "DELETE":
                curl_setopt($curl, CURLOPT_URL, $url);//目标地址
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
                break;
        }

        //请求头,默认为application/json
        if ($headers != "") {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        } else {
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);//返回结果，不输出
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);//超时时间

        if ($returnHeader) {
            // 返回 response_header, 该选项非常重要,如果不为 true, 只会获得响应的正文
            curl_setopt($curl, CURLOPT_HEADER, true);
            // 是否不需要响应的正文,为了节省带宽及时间,在只需要响应头的情况下可以不要正文
//            curl_setopt($curl, CURLOPT_NOBODY, true);
        }


//        用于出错调试
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        $file_contents = curl_exec($curl);//获得返回值
//        // 获得响应结果里的：头大小
//        $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
//        var_dump($headerSize);
//        // 根据头大小去获取头信息内容
//        $header = substr($file_contents, 0, $headerSize);
//        var_dump($header);
        curl_close($curl);
        return $file_contents;
    }


    public function uploadFile($URL, $file_data = array('name' => '', 'path' => ''), $post_data = array(), $timeout = 5){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $URL);//目标地址

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);//返回结果，不输出。不设置会默认输出返回值
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);//超时时间

        if ($post_data != false) {
            foreach ($post_data as $key => $value) {
                $params[$key] = $value;
            }
        }
//        $params[$file_data['name']]=new \CURLFile($file_data['path']);
        $params[$file_data['name']] = curl_file_create($file_data['path'], 'image/jpg', $file_data['path']);;
        var_dump($params);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);

        $file_contents = curl_exec($curl);//获得返回值
        curl_close($curl);
        return $file_contents;
    }
}
