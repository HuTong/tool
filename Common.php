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
		$exp = explode('.', $fileName);
		$ext = end($exp);

        return strtolower($ext);
	}

	// 转换大小单位
    public static function getFormatBytes($size)
    {
        $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');

        return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
    }

	/**
	 * 判断是否使用代理 只能判断一般的普通代理和通过header模拟ip的情况
	 *
	 * 普通代理一般存在 HTTP_VIA/HTTP_X_FORWARDED_FOR/HTTP_X_PROXY_ID 等特性
	 * HTTP_X_FORWARDED_FOR HTTP_CLIENT_IP  可以通过header模拟 不能提供参考
	 *
	 * @return boolean
	 * @author hutong
	 * @date   2017-04-12T13:27:52+080
	 */
	public static function isProxy()
	{
		if(isset($_SERVER['HTTP_VIA']))
		{
			return true;
		}elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != $_SERVER['REMOTE_ADDR']){
			return true;
		}elseif(isset($_SERVER['HTTP_CLIENT_IP']) && $_SERVER['HTTP_CLIENT_IP'] != $_SERVER['REMOTE_ADDR']){
			return true;
		}

		return false;
	}

	/**
	 * 获取客户端访问IP
	 * 因为客户端可以模拟 HTTP_X_FORWARDED_FOR和HTTP_CLIENT_IP 所以获取ip的时候不考虑
	 *
	 * @return string
	 * @author hutong
	 * @date   2017-04-12T13:46:04+080
	 */
	public function getIp($ignoreProxy = true)
	{
		if($ignoreProxy)
		{
			return getenv('REMOTE_ADDR');
		}else{
			if(getenv('HTTP_X_FORWARDED_FOR'))
			{
				$ip = getenv('HTTP_X_FORWARDED_FOR');
			}elseif(getenv('HTTP_CLIENT_IP')){
				$ip = getenv('HTTP_CLIENT_IP');
			}else{
				$ip = getenv('REMOTE_ADDR');
			}
			return $ip;
		}
	}
}
