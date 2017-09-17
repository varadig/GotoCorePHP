<?php
/**
 * Created by IntelliJ IDEA.
 * User: varadig
 * Date: 2013.11.15.
 * Time: 13:27
 * To change this template use File | Settings | File Templates.
 */

namespace core\filesystem\base;

use core\base\CoreBaseClass;

include_once "core/base/CoreBaseClass.php";


class CoreBaseFileSystem extends CoreBaseClass
{
    protected function getFullPath($path)
    {
        return $dir = dirname(__FILE__);
    }

    public function getFiles($path)
    {
        return $this->directoryListing(realpath($path), true);
    }

    public function getSubFolders($path)
    {
        return $this->directoryListing(realpath($path), false);
    }

    private function directoryListing($path, bool $searchAsFile)
    {
        $content = scandir(realpath($path));
        $result = array();
        foreach ($content as $file)
            if (!$searchAsFile)
                if (is_dir($file))
                    array_push($result, $file);
                else
                    if (!is_dir($file))
                        array_push($result, $file);
        return $result;
    }

    public function fileExists($path)
    {

        return file_exists(realpath($path));
    }

    public function folderExists($path)
    {
        return file_exists(realpath($path));
    }

    public function createFolder($path, $permission = 0777)
    {
        return mkdir(realpath($path), intval($permission), true);
    }

    public function copyFile($from, $to)
    {
        return copy($from, $to);
    }

    public function copyFolder($from, $to)
    {
    }

    public function writeTextFile($path, $content, $appendable = false)
    {
        $this->writeFile($path, $content, $appendable);
    }

    public function writeBinaryFile($path, $content, $appendable = false)
    {
        $this->writeFile($path, $content, $appendable);
    }

    private function writeFile($path, $content, $appendable)
    {
        if ($appendable)
            file_put_contents($path, $content, FILE_APPEND);
        else
            file_put_contents($path, $content);
    }

    public function readTextFile($path)
    {
        $this->readFile($path);
    }

    public function readBinaryFile($path)
    {
        $this->readFile($path);
    }

    private function readFile($path)
    {
        return file_get_contents($path);
    }


    public function deleteFile($path)
    {
        unlink(realpath($path));
    }

    public function deleteFolder($path)
    {
        rmdir(realpath($path));
    }

    public function getFileParts($path)
    {
        return pathinfo(realpath($path));
    }
}
