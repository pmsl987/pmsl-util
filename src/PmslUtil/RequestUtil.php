<?php
/**
 * Created by PhpStorm.
 * User: pmsl
 * Date: 17-8-24
 * Time: 下午3:05
 * 用途:
 */

namespace PmslUtil;


class RequestUtil {
    /**
     * 是否是AJAx提交的
     * @return bool
     */
    public static function isAjax(){
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 是否是GET提交的
     */
    public static function isGet(){
        return $_SERVER['REQUEST_METHOD'] == 'GET' ? true : false;
    }

    /**
     * 是否是POST提交
     * @return int
     */
    public static function isPost(){
        return $_SERVER['REQUEST_METHOD'] == 'POST' ? true : false;
    }
}