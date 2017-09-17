<?php
/**
 * Created by PhpStorm.
 * User: pmsl
 * Date: 17-8-21
 * Time: 下午4:11
 * 用途:
 */

namespace PmslUtil;


class StringUtil {

    /**
     * get rand str
     *
     * @param	int	    $length		获取的随机数长度
     * @param	string	$all	    随机数的可能值
     * @return	string
     */
    public static function rand_str($length=4,$all='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'){
        $len = strlen($all);
        $str='';
        for($i=0 ; $i<$length; $i++){
            $str .= $all[rand(0,$len-1)];
        }
        return $str;
    }
}