<?php
namespace Raketsky\Helper;

/**
 * File Helper
 */
class FileHelper
{
    /**
     * @param string $url
     *
     * @return bool
     */
    public static function isUrlExists($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $code == 200;
    }

    /**
     * Checks directory, and if dir exists, than returns true. Or tries to create it.
     *
     * @param string $dir    Path to a directory
     * @param bool   $create Create if not exist
     * @param int    $mode   CHMOD
     *
     * @return bool
     */
    public static function isDirExists($dir, $create = false, $mode = 0777)
    {
        if (is_dir($dir)) {
            return true;
        }
        if ($create) {
            is_dir(dirname($dir)) || static::isDirExists(dirname($dir), $mode);

            return is_dir($dir) || @mkdir($dir, $mode); # @mkdir($dir, 0777)
        } else {
            return is_dir($dir);
        }
    }
}
