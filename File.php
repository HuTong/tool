<?php
/**
 * 文件系统操作
 */
namespace Hutong\Tool;

class File
{
    public static function createDir($directory)
    {
        if (!is_dir($directory))
        {
            return @mkdir($directory, 0777, true);
        }

        return false;
    }

    public static function delDir($directory)
    {
        if (!is_dir($directory))
        {
            return false;
        }

        $items = new \FilesystemIterator($directory);

        foreach ($items as $item)
        {
            if ($item->isDir() && !$item->isLink())
            {
                $this->delDir($item->getPathname());
            } else {
                @unlink($item->getPathname());
            }
        }

        @rmdir($directory);

        return true;
    }
}
