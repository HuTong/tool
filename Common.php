<?php
namespace Hutong\Tool;
/**
 * @desc 常用方法
 */
class Common
{
	/**
	 * 获取随机字符串
	 *
	 * @param  integer $num
	 * @param  integer $type 0.数字字母组合 1.数组 2.字母
	 * @return [type]
	 * @author hutong
	 * @date   2017-03-29T16:37:32+080
	 */
	public static function getRandomStr($num = 4, $type = 0)
	{
	    $code = '';

	    $decimal = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9,);
	    $letter = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');

	    if($type == 0)
	    {
	        $codes = array_merge($decimal, $letter);
	    }else if ($type == 1){
	        $codes = $decimal;
	    }else{
	        $codes = $letter;
	    }

	    for ($i = 0; $i < $num; $i++)
	    {
	        $code .= $codes[array_rand($codes)];
	    }

	    return $code;
	}

	/**
	 * 返回扩展名
	 *
	 * @param  [type] $fileName
	 * @return [type]
	 * @author hutong
	 * @date   2017-03-29T16:37:07+080
	 */
	public static function getExtension($fileName)
	{
		$ext = explode('.', $fileName);
        $ext = array_pop($ext);

        return strtolower($ext);
	}

	// 转换大小单位
    public static function getFormatBytes($size)
    {
        $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');

        return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
    }
}
