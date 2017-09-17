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

    /**
     * 格式化
     * @param $price
     * @return string
     */
    function convertPrice($price)
    {
        $len=strlen($price);
        $wan = $len>=5?substr($price,0,$len-4):0;
        $qian = $len>=4?substr($price,$len-4,1):0;
        $yuan = $len>=3?substr($price,$len-3,3):$price;
        $yuan = preg_replace('/^[0]*/', '', $yuan);
        $priceStr='';
        if($wan!='0'){
            $priceStr.=$wan.'万';
        }
        if($qian!='0'){
            $priceStr.=$qian.'千';
        }
        if($yuan!=''){
            $priceStr.=$yuan.'元';
        }
        return $priceStr;
    }

}