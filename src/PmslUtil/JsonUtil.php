<?php
/**
 * Created by PhpStorm.
 * User: pmsl
 * Date: 17-8-6
 * Time: 下午9:44
 * 用途:
 */

namespace PmslUtil;


class JsonUtil {
    public static function success($status,$message=''){
        $data = array();
        $data['status']=$status;
        if(!empty($message)){
        $data['message']=$message;
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE || JSON_UNESCAPED_SLASHES);
        exit;
    }
    public static function error($status,$error=''){
        $data = array();
        $data['status']=$status;
        if(!empty($error)){
            $data['error']=$error;
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE || JSON_UNESCAPED_SLASHES);
        exit;
    }
}