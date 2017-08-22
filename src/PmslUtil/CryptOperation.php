<?php
namespace PmslUtil;

/**
 * Created by PhpStorm.
 * User: pmsl
 * Date: 17-5-17
 * Time: 下午7:49
 * 用途:
 */

/**
 * Class CryptOperation
 * @package extra
 * 使用示例:
 *
 * //        MCRYPT_MODE_ECB模式不使用mcrypt_create_iv()创建的随机初始向量,所以重复加密都是相同的值
 *  $aes=new CryptOperation(MCRYPT_RIJNDAEL_128,MCRYPT_MODE_ECB);
 * //        其他模式使用mcrypt_create_iv()创建的随机初始向量,所以重复加密都是不相同的值
 * //        $aes=new AesOperation(MCRYPT_BLOWFISH,MCRYPT_MODE_CBC);
 *   $plain_text=$aes->encrypt('abc','123456789');
 *    var_dump($plain_text);
 *    var_dump($aes->decrypt('abc',$plain_text));
 */
class CryptOperation
{
    /**
     * 获取mcrypt支持的加密算法列表
     */
    public function getAlgorithms()
    {
        return mcrypt_list_algorithms();
//        var_dump(mcrypt_list_algorithms());
    }

    /**
     * 获取mcrypt支持的加密模式列表
     */
    public function getMode()
    {
        return mcrypt_list_modes();
//        var_dump(mcrypt_list_modes());
    }
    private $algorithm;
    private $mode;
    private $iv;
    public function __construct($algorithm, $mode)
    {
        $this->algorithm=$algorithm;
        $this->mode=$mode;
        $this->iv = mcrypt_create_iv(mcrypt_get_iv_size($algorithm, $mode), MCRYPT_DEV_RANDOM);
    }

    /**
     *
     * @param $key
     * @param $data
     * @return string
     */
    public function encrypt($key, $data)
    {
        //        部分加密算法只支持 16, 24 or 32长度的字符串,需要使用md5()函数将其转换为32位的字符串
        $key=md5($key);
        $encrypted_data=mcrypt_encrypt($this->algorithm, $key, $data, $this->mode, $this->iv);
        $plain_text=base64_encode($encrypted_data);
        return $plain_text;
    }
    public function decrypt($key, $plain_text)
    {
        //        部分加密算法只支持 16, 24 or 32长度的字符串,需要使用md5()函数将其转换为32位的字符串
        $key=md5($key);
        $encrypted_data=base64_decode($plain_text);
        $decoded=mcrypt_decrypt($this->algorithm, $key, $encrypted_data, $this->mode, $this->iv);
//        trim()可以删除mcrypt_decrypt()在末尾增加的NULL字节
        return trim($decoded);
    }
}
