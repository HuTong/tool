<?php
namespace Hutong\Tool;
/**
 * @desc 日志方法
 */
class Log
{
	public static $log_show = false;
    public static $log_type = false;
    public static $log_file = "";
    public static $out_sta = "";
    public static $out_end = "";

    public static function note($msg)
    {
        self::$out_sta = self::$out_end = "";
        self::msg($msg, 'note');
    }

    public static function info($msg)
    {
        self::$out_sta = self::$out_end = "";
        self::msg($msg, 'info');
    }

    public static function warn($msg)
    {
        self::$out_sta = self::$out_end = "";
        if (!util::is_win()) 
        {
            self::$out_sta = "\033[33m";
            self::$out_end = "\033[0m";
        }

        self::msg($msg, 'warn');
    }

    public static function debug($msg)
    {
        self::$out_sta = self::$out_end = "";
        if (!util::is_win()) 
        {
            self::$out_sta = "\033[36m";
            self::$out_end = "\033[0m";
        }

        self::msg($msg, 'debug');
    }

    public static function error($msg)
    {
        self::$out_sta = self::$out_end = "";
        if (!util::is_win()) 
        {
            self::$out_sta = "\033[31m";
            self::$out_end = "\033[0m";
        }

        self::msg($msg, 'error');
    }

    public static function msg($msg, $log_type)
    {
        if ($log_type != 'note' && self::$log_type && strpos(self::$log_type, $log_type) === false) 
        {
            return false;
        }

        if ($log_type == 'note') 
        {
            $msg = self::$out_sta. $msg . "\n".self::$out_end;
        }
        else 
        {
            $msg = self::$out_sta.date("Y-m-d H:i:s")." [{$log_type}] " . $msg .self::$out_end. "\n";
        }

        if(self::$log_show)
        {
            echo $msg;
        }
        
        if(is_file(self::$log_file))
        {
        	file_put_contents(self::$log_file, $msg, FILE_APPEND | LOCK_EX);
        }
    }
}
