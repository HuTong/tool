<?php
namespace Hutong\Tool;
/**
 * @desc 解析数组、xml之间的相互转化
 */
class ArrXmlParse
{
    //文档对象
    private static $doc = NULL;
    //key补充
	private static $keyReplenish = 'item';

    /**
     * 初始化文档版本及编码
     *
     * @param string $version   版本号
     * @param string $encoding  XML编码
     */
    private static function init($version, $encoding)
    {
        self::$doc = new DomDocument($version, $encoding);
        self::$doc->formatOutput = true;
    }

    /**
     * 转换XML到数组
     *
     * @param string $xml	要转换的XML
     * @param bool	 $rtype	要输出的格式:true-数组/false-对象
     * */
    public static function parseXml($xml,$rtype = true)
    {
    	$xml = simplexml_load_string($xml);
    	$json= json_encode($xml);
    	$return = json_decode($json, $rtype);
    	return $return;
    }

    /**
     * 转换数组到XML
     *
     * @param array $array      要转换的数组
     * @param string $rootName  要节点名称
     * @param string $version   版本号
     * @param string $encoding  XML编码
     *
     * @return string
     */
    public static function parseArr($array, $rootName = 'root', $version = '1.0', $encoding = 'UTF-8')
    {
        self::init($version, $encoding);

        //转换
        $node = self::convert($array, $rootName);
        self::$doc->appendChild($node);

        return self::$doc->saveXML();
    }

    /**
     * 递归转换
     *
     * @param array $array      数组
     * @param string $nodeName  节点名称
     *
     * @return object (DOMElement)
     */
    private static function convert($array, $nodeName)
    {
        if (!is_array($array)){return false;}

        //创建父节点
        $node = self::createNode($nodeName);

        //循环数组
        foreach ($array as $key => $value)
        {
            $element = self::createNode($key);

            //如果不是数组，则创建节点的值
            if (!is_array($value))
            {
                $element->appendChild(self::createValue($value));
                $node->appendChild($element);
            } else {
                //如果是数组，则递归
                $node->appendChild(self::convert($value, $key, $element));
            }
        }
        return $node;
    }

    private static function createNode($name)
    {
        $node = NULL;

        //如果是字符串，则创建节点
        if (!is_numeric($name))
        {
            $node = self::$doc->createElement($name);
        } else {
            //如果是数字，则创建默认item节点
            $node = self::$doc->createElement(self::$keyReplenish);
        }

        return $node;
    }

    /**
     * 创建文本节点
     *
     * @param string || bool || integer $value
     *
     * @return object (DOMText || DOMCDATASection );
     */
    private static function createValue($value)
    {
        $textNode = NULL;

        //如果是bool型，则转换为字符串
        if (true === $value || false === $value)
        {
            $textNode = self::$doc->createTextNode($value ? 'true' : 'false');
        } else {
            //如果含有HTML标签，则创建CDATA节点
            if (strpos($value, '<') > -1)
            {
                $textNode = self::$doc->createCDATASection($value);
            } else {
                $textNode = self::$doc->createTextNode($value);
            }
        }

        return $textNode;
    }
}
