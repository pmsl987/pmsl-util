<?php
/**
 * Created by PhpStorm.
 * User: pmsl
 * Date: 17-4-27
 * Time: 下午7:30
 * 用途:
 */
namespace PmslUtil;

use \DOMDocument;

class XmlUtil
{
    /**
     *
     * @param $head_tag
     * @param $sub_head_tag
     * @param $content
     *
     * 使用示例：
     * $arr=array(array('name'=>'Modern Family','channel'=>'ABC'),array('name'=>'DDD&','channel'=>'EEEE'));
     * $xml=new XmlUtil();
     * $xml->createXml('shows','show',$arr);
     */
    public function createXml($head_tag, $sub_head_tag, $content)
    {
        //        设置发送的是xml而不是html
        header('Content-Type:text/xml');
        print '<?xml version="1.0"?>' . "\n";
        print "<$head_tag>\n";
        foreach ($content as $subcontent) {
            print "<$sub_head_tag>\n";
            foreach ($subcontent as $tag => $data) {
                print "<$tag>".htmlspecialchars($data)."</$tag>\n";
            }
            print "</$sub_head_tag>\n";
        }
        print "</$head_tag>\n";
    }

    public function generateXml($root_tag, $content)
    {
        $dom = new DOMDocument("1.0");
        $root=$dom->createElement($root_tag);
        $dom->appendChild($root);
        foreach ($content as $tag_name => $data) {
            $tag=$dom->createElement($tag_name);
            $root->appendChild($tag);
            $tag->appendChild($dom->createTextNode($data));
        }
        $dom->formatOutput=true;
        echo $dom->saveXML();
    }

    public function generateCDATAXml($root_tag, $content)
    {
        $dom = new DOMDocument("1.0");
        $root=$dom->createElement($root_tag);
        $dom->appendChild($root);
        foreach ($content as $tag_name => $data) {
            if (is_array($data)) {
                $tag=$dom->createElement($tag_name);
                $root->appendChild($tag);
                foreach ($data as $k => $v) {
                    $othor_tag=$dom->createElement($k);
                    $othor_tag->appendChild($dom->createCDATASection($v));
                    $tag->appendChild($othor_tag);
                }
            } else {
                $tag=$dom->createElement($tag_name);
                $root->appendChild($tag);
                $tag->appendChild($dom->createCDATASection($data));
            }
        }
        $dom->formatOutput=true;
        $myfile = fopen("newout.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $dom->saveXML() . "\n");
        fclose($myfile);
        echo $dom->saveXML();
    }
}
