<?php
namespace Raketsky\Helper;

/**
 * File Helper
 */
class FileHelper
{
    /**
     * Checks directory, and if dir exists, than returns true. Or tries to create it.
     *
     * @param string $dir    Path to a directory
     * @param bool   $create Create if not exist
     * @param int    $mode   CHMOD
     *
     * @return bool
     */
    public static function dirExists($dir, $create = false, $mode = 0777)
    {
        if (is_dir($dir)) {
            return true;
        }
        if ($create) {
            is_dir(dirname($dir)) || self::dirExists(dirname($dir), $mode);

            return is_dir($dir) || @mkdir($dir, $mode); # @mkdir($dir, 0777)
        } else {
            return is_dir($dir);
        }
    }
}
