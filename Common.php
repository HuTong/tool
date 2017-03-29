<?php
namespace Hutong\Tool;
/**
 * @desc 常用方法
 */
class Common
{
	public static function createStr($num = 4, $type = 0)
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
}
