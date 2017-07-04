<?php
namespace Hutong\Tool;
/**
 * @desc 该类来源于phpspider 用来做数据的采集解析
 */
class Selector
{
    public static $dom = null;
    public static $dom_auth = null;
    public static $xpath = null;
    public static $error = null;

    public static function select($html, $selector, $selector_type = 'xpath')
    {
        if (empty($html) || empty($selector))
        {
            return false;
        }

        $selector_type = strtolower($selector_type);
        if ($selector_type == 'xpath')
        {
            return self::_xpath_select($html, $selector);
        }
        elseif ($selector_type == 'regex')
        {
            return self::_regex_select($html, $selector);
        }
    }

    /**
     * xpath选择器
     *
     * @param mixed $html
     * @param mixed $selector
     * @return void
     */
    private static function _xpath_select($html, $selector)
    {
        if (!is_object(self::$dom))
        {
            self::$dom = new \DOMDocument();
        }

        // 如果加载的不是之前的HTML内容，替换一下验证标识
        if (self::$dom_auth != md5($html))
        {
            self::$dom_auth = md5($html);
            @self::$dom->loadHTML('<?xml encoding="UTF-8">'.$html);
            self::$xpath = new \DOMXpath(self::$dom);
        }

        $elements = @self::$xpath->query($selector);
        if ($elements === false)
        {
            self::$error = "the selector in the xpath(\"{$selector}\") syntax errors";
            return false;
        }

        $result = array();
        if (!is_null($elements))
        {
            foreach ($elements as $element)
            {
                $nodeName = $element->nodeName;
                $nodeType = $element->nodeType;     // 1.Element 2.Attribute 3.Text
   
                // 如果是img标签，直接取src值
                if ($nodeType == 1 && in_array($nodeName, array('img')))
                {
                    $content = $element->getAttribute('src');
                }
                // 如果是标签属性，直接取节点值
                elseif ($nodeType == 2 || $nodeType == 3 || $nodeType == 4)
                {
                    $content = $element->nodeValue;
                }
                else
                {
                    // 保留nodeValue里的html符号，给children二次提取
                    $content = self::$dom->saveXml($element);
                    //$content = trim(self::$dom->saveHtml($element));
                    $content = preg_replace(array("#^<{$nodeName}.*>#isU","#</{$nodeName}>$#isU"), array('', ''), $content);
                }
                $result[] = $content;
            }
        }
        if (empty($result))
        {
            return false;
        }
        // 如果只有一个元素就直接返回string，否则返回数组
        return count($result) > 1 ? $result : $result[0];
    }

    /**
     * 正则选择器
     *
     * @param mixed $html
     * @param mixed $selector
     * @return void
     */
    private static function _regex_select($html, $selector)
    {
        if(@preg_match_all($selector, $html, $out) === false)
        {
            self::$error = "the selector in the regex(\"{$selector}\") syntax errors";
            return false;
        }
        $count = count($out);
        $result = array();
        // 一个都没有匹配到
        if ($count == 0)
        {
            return false;
        }
        // 只匹配一个，就是只有一个 ()
        elseif ($count == 2)
        {
            $result = $out[1];
        }
        else
        {
            for ($i = 1; $i < $count; $i++)
            {
                // 如果只有一个元素，就直接返回好了
                $result[] = count($out[$i]) > 1 ? $out[$i] : $out[$i][0];
            }
        }
        if (empty($result))
        {
            return false;
        }

        return count($result) > 1 ? $result : $result[0];
    }
}