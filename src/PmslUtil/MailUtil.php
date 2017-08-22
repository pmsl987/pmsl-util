<?php
/**
 * Created by PhpStorm.
 * User: pmsl
 * Date: 17-8-22
 * Time: 下午4:11
 * 用途: 邮件工具
 */

namespace PmslUtil;

class MailUtil
{
    /**
     *
     * @param $email 接受者邮箱
     * @param $subject 邮件主题名
     * @param $body body
     * @param bool $backupBody 对于不支持html客户端备用的body
     * @param bool $attachmentPath 附件的本地路径
     * @return bool|string 成功发送返回true，不成功发送返回错误信息
     */
    public static function send($email, $subject, $body, $backupBody = false, $attachmentPath = false)
    {
        require 'PHPMailerAutoload.php';
        $mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.126.com;smtp.163.com';  // Specify main and backup SMTP servers(设置smtp服务器)
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'pmsl987@163.com';                 // SMTP username
        $mail->Password = 'wy_z1x2c3v4b5';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 25;                                    // TCP port to connect to

        $mail->setFrom('pmsl', 'Mailer');
//        $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
        $mail->addAddress($email);               // Name is optional
//        $mail->addReplyTo('info@example.com', 'Information');//增加回复标签
//        $mail->addCC('cc@example.com');
//        $mail->addBCC('bcc@example.com');

        //附件
        if (!$attachmentPath) {
            $mail->addAttachment($attachmentPath);
        }
//        $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body = $body;
        if (!$backupBody) {
            $mail->AltBody = $backupBody;
        }

        if (!$mail->send()) {
            return 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            return true;
        }
    }
}
