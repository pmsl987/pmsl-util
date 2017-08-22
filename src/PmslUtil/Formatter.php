<?php
/**
 * Created by PhpStorm.
 * User: pmsl
 * Date: 17-8-10
 * Time: 下午3:15
 * 用途:
 */

namespace PmslUtil;


class Formatter {
    // 格式化打印的工具
    public static function printVariable($var){
        echo "<pre>";print_r($var);echo "<pre>";
    }
}