<?php

/**
 * Created by PhpStorm.
 * User: pmsl
 * Date: 17-4-28
 * Time: 下午1:45
 * 用途:
 */
namespace WeixinUtil;

use \DOMDocument;
use PmslUtil\XmlUtil;

class WeixinMessage
{
    //    重试的消息排重，有msgid的消息推荐使用msgid排重。事件类型消息推荐使用FromUserName + CreateTime 排重。

    public function parseMessage()
    {
        $fileContent = file_get_contents("php://input");
        $xml = simplexml_load_string($fileContent);//转换post数据为simplexml对象
        $xml_children = $xml->children();

        switch ($xml_children->MsgType) {
            case 'text':
                $this->textParse($xml_children);
                break;
            case 'image':
                $this->imageParse($xml_children);
                break;
            case 'voice':
                $this->voiceParse($xml_children);
                break;
            case 'video':
                $this->videoParse($xml_children);
                break;
            case 'location':
                $this->locationParse($xml_children);
                break;
            case 'link':
                $this->linkParse($xml_children);
                break;
            case 'event':
                $this->eventParse($xml_children);
                break;
            default:
                break;
        }
    }

    private function textParse($xml_children)
    {
        $myfile = fopen("newtext.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $xml_children->ToUserName . "\n");
        fwrite($myfile, $xml_children->FromUserName . "\n");
        fwrite($myfile, $xml_children->CreateTime . "\n");
        fwrite($myfile, $xml_children->MsgType . "\n");
        fwrite($myfile, $xml_children->Content . "\n");
        fwrite($myfile, $xml_children->MsgId . "\n");
        fclose($myfile);
        $xml=new XmlUtil();
        $xml->generateCDATAXml('xml', array(
                'ToUserName'=>$xml_children->FromUserName,
                'FromUserName'=>$xml_children->ToUserName,
                'CreateTime'=>time(),
                'MsgType'=>'news',
                'ArticleCount'=>2,
                'Articles'=>array('item'=>array('Title'=>'title1','Description'=>'description1','PicUrl'=>'picurl','Url'=>'url'),'item'=>array('Title'=>'title1','Description'=>'description1','PicUrl'=>'picurl','Url'=>'url'))
            )
        );
    }

    private function imageParse($xml_children)
    {
        $myfile = fopen("newimage.txt", "a") or die("Unable to open file!");
        fwrite($myfile, $xml_children->ToUserName . "\n");
        fwrite($myfile, $xml_children->FromUserName . "\n");
        fwrite($myfile, $xml_children->CreateTime . "\n");
        fwrite($myfile, $xml_children->MsgType . "\n");
        fwrite($myfile, $xml_children->PicUrl . "\n");
        fwrite($myfile, $xml_children->MediaId . "\n");
        fwrite($myfile, $xml_children->MsgId . "\n");
        fclose($myfile);
//        $xml=new XmlUtil();
//        $xml->generateCDATAXml('xml', array(
//                'ToUserName'=>$xml_children->FromUserName,
//                'FromUserName'=>$xml_children->ToUserName,
//                'CreateTime'=>time(),
//                'MsgType'=>$xml_children->MsgType,
//                 'Image'=>array('MediaId'=>$xml_children->MediaId)
//            )
//        );
        $dom = new DOMDocument("1.0");
        $xml = $dom->createElement('xml');
        $dom->appendChild($xml);
        $toUserName=$dom->createElement('ToUserName');
        $toUserName->appendChild($dom->createCDATASection($xml_children->FromUserName));
        $xml->appendChild($toUserName);

        $fromUserName=$dom->createElement('FromUserName');
        $fromUserName->appendChild($dom->createCDATASection($xml_children->ToUserName));
        $xml->appendChild($fromUserName);

        $createTime=$dom->createElement('CreateTime');
        $createTime->appendChild($dom->createCDATASection(time()));
        $xml->appendChild($createTime);

        $msgType=$dom->createElement('MsgType');
        $msgType->appendChild($dom->createCDATASection('news'));
        $xml->appendChild($msgType);

        $articleCount=$dom->createElement('ArticleCount');
        $articleCount->appendChild($dom->createCDATASection(1));
        $xml->appendChild($articleCount);

        $articles=$dom->createElement('Articles');
        $item1=$dom->createElement('item');
        $title=$dom->createElement('Title');
        $title->appendChild($dom->createCDATASection('title1'));
        $item1->appendChild($title);
        $description=$dom->createElement('Description');
        $description->appendChild($dom->createCDATASection('description1'));
        $item1->appendChild($description);
        $picUrl=$dom->createElement('PicUrl');
        $picUrl->appendChild($dom->createCDATASection($xml_children->PicUrl));
        $item1->appendChild($picUrl);
        $url=$dom->createElement('Url');
        $url->appendChild($dom->createCDATASection('http://www.baidu.com'));
        $item1->appendChild($url);
        $articles->appendChild($item1);



//        $item2=$dom->createElement('item');
//        $title=$dom->createElement('Title');
//        $title->appendChild($dom->createCDATASection('title2'));
//        $item2->appendChild($title);
//        $description=$dom->createElement('Description');
//        $description->appendChild($dom->createCDATASection('description2'));
//        $item2->appendChild($description);
//        $picUrl=$dom->createElement('PicUrl');
//        $picUrl->appendChild($dom->createCDATASection($xml_children->PicUrl));
//        $item2->appendChild($picUrl);
//        $url=$dom->createElement('Url');
//        $url->appendChild($dom->createCDATASection('http://www.baidu.com'));
//        $item2->appendChild($url);
//        $articles->appendChild($item2);

        $xml->appendChild($articles);

        $dom->formatOutput=true;
        $myfile = fopen("newout.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $dom->saveXML() . "\n");
        fclose($myfile);
        echo $dom->saveXML();
    }

    private function voiceParse($xml_children)
    {
        $myfile = fopen("newvoice.txt", "a") or die("Unable to open file!");
        fwrite($myfile, $xml_children->ToUserName . "\n");
        fwrite($myfile, $xml_children->FromUserName . "\n");
        fwrite($myfile, $xml_children->CreateTime . "\n");
        fwrite($myfile, $xml_children->MsgType . "\n");
        fwrite($myfile, $xml_children->MediaId . "\n");
        fwrite($myfile, $xml_children->Format . "\n");
        fwrite($myfile, $xml_children->MsgId . "\n");
        fclose($myfile);
        $xml=new XmlUtil();
        $xml->generateCDATAXml('xml', array(
                'ToUserName'=>$xml_children->FromUserName,
                'FromUserName'=>$xml_children->ToUserName,
                'CreateTime'=>time(),
                'MsgType'=>$xml_children->MsgType,
                'Voice'=>array('MediaId'=>$xml_children->MediaId)
            )
        );
    }
    private function videoParse($xml_children)
    {
        $myfile = fopen("newvideo.txt", "a") or die("Unable to open file!");
        fwrite($myfile, $xml_children->ToUserName . "\n");
        fwrite($myfile, $xml_children->FromUserName . "\n");
        fwrite($myfile, $xml_children->CreateTime . "\n");
        fwrite($myfile, $xml_children->MsgType . "\n");
        fwrite($myfile, $xml_children->MediaId . "\n");
        fwrite($myfile, $xml_children->ThumbMediaId . "\n");
        fwrite($myfile, $xml_children->MsgId . "\n");
        fclose($myfile);
        $xml=new XmlUtil();
        $xml->generateCDATAXml('xml', array(
                'ToUserName'=>$xml_children->FromUserName,
                'FromUserName'=>$xml_children->ToUserName,
                'CreateTime'=>time(),
                'MsgType'=>$xml_children->MsgType,
                'Video'=>array('MediaId'=>$xml_children->MediaId,'Title'=>'视频标题 可选','Description'=>'视频消息的描述 可选')
            )
        );
    }
    private function locationParse($xml_children)
    {
        $myfile = fopen("newlocation.txt", "a") or die("Unable to open file!");
        fwrite($myfile, $xml_children->ToUserName . "\n");
        fwrite($myfile, $xml_children->FromUserName . "\n");
        fwrite($myfile, $xml_children->CreateTime . "\n");
        fwrite($myfile, $xml_children->MsgType . "\n");
        fwrite($myfile, $xml_children->Location_X . "\n");
        fwrite($myfile, $xml_children->Location_Y . "\n");
        fwrite($myfile, $xml_children->Scale . "\n");
        fwrite($myfile, $xml_children->Label . "\n");
        fwrite($myfile, $xml_children->MsgId . "\n");
        fclose($myfile);
    }
    private function linkParse($xml_children)
    {
        $myfile = fopen("newlink.txt", "a") or die("Unable to open file!");
        fwrite($myfile, $xml_children->ToUserName . "\n");
        fwrite($myfile, $xml_children->FromUserName . "\n");
        fwrite($myfile, $xml_children->CreateTime . "\n");
        fwrite($myfile, $xml_children->MsgType . "\n");
        fwrite($myfile, $xml_children->Title . "\n");
        fwrite($myfile, $xml_children->Description . "\n");
        fwrite($myfile, $xml_children->Url . "\n");
        fwrite($myfile, $xml_children->MsgId . "\n");
        fclose($myfile);
    }
    private function eventParse($xml_children)
    {
        $myfile = fopen("newevent.txt", "a") or die("Unable to open file!");
        fwrite($myfile, $xml_children->ToUserName . "\n");
        fwrite($myfile, $xml_children->FromUserName . "\n");
        fwrite($myfile, $xml_children->CreateTime . "\n");
        fwrite($myfile, $xml_children->MsgType . "\n");
        fwrite($myfile, $xml_children->Event . "\n");


        switch ($xml_children->Event) {
//            用户未关注时，进行关注后的事件推送
            case 'subscribe':
                fwrite($myfile, $xml_children->EventKey . "\n");
                fwrite($myfile, $xml_children->Ticket . "\n");
                break;
//             用户已关注时的事件推送
            case 'SCAN':
                fwrite($myfile, $xml_children->EventKey . "\n");
                fwrite($myfile, $xml_children->Ticket . "\n");
                break;
//            上报地理位置事件
            case 'LOCATION':
                fwrite($myfile, $xml_children->Latitude . "\n");
                fwrite($myfile, $xml_children->Longitude . "\n");
                fwrite($myfile, $xml_children->Precision . "\n");

                break;
//            点击菜单拉取消息时的事件推送
//            注意，点击菜单弹出子菜单，不会产生上报。
            case 'CLICK':
                fwrite($myfile, $xml_children->EventKey . "\n");
                break;
//            点击菜单跳转链接时的事件推送
            case 'VIEW':
                fwrite($myfile, $xml_children->EventKey . "\n");
                break;
            default:
                break;
        }
        fclose($myfile);
    }
}
