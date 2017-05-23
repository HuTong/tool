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
	public static function getIp($ignoreProxy = true)
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

	/**
	 * 加密函数
	 *
	 * @param string $txt 需要加密的字符串
	 * @param string $key 密钥
	 *
	 * @return string 返回加密结果
	 * @author hutong
	 * @date   2017-05-23T17:20:29+080
	 */
	public static function encrypt($txt, $key = '123456')
	{
		if(empty($txt))
		{
			return $txt;
		}

		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_.";
		$ikey ="-x6g6ZWm2G9g_vr0Bo.pOq3kRIxsZ6rm";

		$nh1 = rand(0,64);
		$nh2 = rand(0,64);
		$nh3 = rand(0,64);

		$ch1 = $chars{$nh1};
		$ch2 = $chars{$nh2};
		$ch3 = $chars{$nh3};

		$nhnum = $nh1 + $nh2 + $nh3;

		$knum = 0;$i = 0;

		while(isset($key{$i}))
		{
			$knum +=ord($key{$i++});
		}

		$mdKey = substr(md5(md5(md5($key.$ch1).$ch2.$ikey).$ch3),$nhnum%8,$knum%8 + 16);
		$txt = base64_encode(time().'_'.$txt);
		$txt = str_replace(array('+','/','='),array('-','_','.'),$txt);
		$tmp = '';
		$j=0;$k = 0;
		$tlen = strlen($txt);
		$klen = strlen($mdKey);
		for($i=0; $i<$tlen; $i++)
		{
			$k = $k == $klen ? 0 : $k;
			$j = ($nhnum+strpos($chars,$txt{$i})+ord($mdKey{$k++}))%64;
			$tmp .= $chars{$j};
		}

		$tmplen = strlen($tmp);

		$tmp = substr_replace($tmp,$ch3,$nh2 % ++$tmplen,0);
		$tmp = substr_replace($tmp,$ch2,$nh1 % ++$tmplen,0);
		$tmp = substr_replace($tmp,$ch1,$knum % ++$tmplen,0);

		return $tmp;
	}

	/**
	 * 解密函数
	 *
	 * @param string $txt 需要解密的字符串
	 * @param string $key 密匙
	 * @return string 字符串类型的返回结果
	 *
	 * @author hutong
	 * @date   2017-05-23T17:20:29+080
	 */
	public static function decrypt($txt, $key = '123456', $ttl = 0)
	{
		if(empty($txt))
		{
			return $txt;
		}

		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_.";
		$ikey ="-x6g6ZWm2G9g_vr0Bo.pOq3kRIxsZ6rm";

		$knum = 0;$i = 0;
		$tlen = @strlen($txt);

		while(isset($key{$i}))
		{
			$knum +=ord($key{$i++});
		}

		$ch1 = @$txt{$knum % $tlen};
		$nh1 = strpos($chars,$ch1);
		$txt = @substr_replace($txt,'',$knum % $tlen--,1);
		$ch2 = @$txt{$nh1 % $tlen};
		$nh2 = @strpos($chars,$ch2);
		$txt = @substr_replace($txt,'',$nh1 % $tlen--,1);
		$ch3 = @$txt{$nh2 % $tlen};
		$nh3 = @strpos($chars,$ch3);
		$txt = @substr_replace($txt,'',$nh2 % $tlen--,1);

		$nhnum = $nh1 + $nh2 + $nh3;

		$mdKey = substr(md5(md5(md5($key.$ch1).$ch2.$ikey).$ch3),$nhnum % 8,$knum % 8 + 16);
		$tmp = '';
		$j=0; $k = 0;
		$tlen = @strlen($txt);
		$klen = @strlen($mdKey);
		for($i=0; $i<$tlen; $i++)
		{
			$k = $k == $klen ? 0 : $k;
			$j = strpos($chars,$txt{$i})-$nhnum - ord($mdKey{$k++});
			while ($j<0) $j+=64;
			$tmp .= $chars{$j};
		}

		$tmp = str_replace(array('-','_','.'),array('+','/','='),$tmp);
		$tmp = trim(base64_decode($tmp));

		if(preg_match("/\d{10}_/s",substr($tmp,0,11)))
		{
			if($ttl > 0 && (time() - substr($tmp,0,11) > $ttl))
			{
				$tmp = null;
			}else{
				$tmp = substr($tmp,11);
			}
		}

		return $tmp;
	}
}
