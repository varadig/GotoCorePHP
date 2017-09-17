<?php
/**
 * Created by IntelliJ IDEA.
 * User: varadig
 * Date: 2013.11.15.
 * Time: 13:22
 * To change this template use File | Settings | File Templates.
 */

namespace core\filesystem;

use core\base\CoreBaseClass;
use core\filesystem\base\CoreBaseFileSystem;

include_once "core/filesystem/base/CoreBaseFileSystem.php";

/**
 * @property CoreBaseFileSystem filesystem
 */
class CoreFileSystem extends CoreBaseClass
{
    const WEB = "web";

    const PATH = 'path';
    const FROM = 'from';
    const TO = 'to';

    const CONTENT = 'content';
    const DATA = 'data';

    const GET_SUB_FOLDERS = 'get.sub.folders';
    const GET_FILES = 'get.files';
    const FILE_EXISTS = 'file.exists';
    const FOLDER_EXISTS = 'folder.exists';
    const CREATE_FOLDER = 'create.folder';
    const COPY_FILE = 'copy.file';
    const COPY_FOLDER = 'copy.folder';
    const CREATE_TEXT_FILE = 'create.text.file';
    const CREATE_BINARY_FILE = 'create.binary.file';
    const APPEND_TEXT_FILE = 'append.text.file';
    const APPEND_BINARY_FILE = 'append.binary.file';
    const READ_TEXT_FILE = 'read.text.file';
    const READ_BINARY_FILE = 'read.binary.file';
    const DELETE_FILE = 'delete.file';
    const DELETE_FOLDER = 'delete.folder';
    const GET_FILE_PARTS = "get.file.parts";


    private static $instance;


    public static function getInstance()
    {
        if (!isset(self::$instance))
            self::$instance = new self;
        return self::$instance;
    }

    public function __construct()
    {
        parent::__construct();
        $this->filesystem = new CoreBaseFileSystem();
        $this->sc->registerService(self::GET_SUB_FOLDERS, array($this, "serviceGetSubFolders"));
        $this->sc->registerService(self::GET_FILES, array($this, "serviceGetFiles"));
        $this->sc->registerService(self::FILE_EXISTS, array($this, "serviceFileExists"));
        $this->sc->registerService(self::FOLDER_EXISTS, array($this, "serviceFolderExists"));
        $this->sc->registerService(self::CREATE_FOLDER, array($this, "serviceCreateFolder"));
        $this->sc->registerService(self::COPY_FILE, array($this, "serviceCopyFile"));
        $this->sc->registerService(self::COPY_FOLDER, array($this, "serviceCopyFolder"));
        $this->sc->registerService(self::CREATE_TEXT_FILE, array($this, "serviceCreateTextFile"));
        $this->sc->registerService(self::CREATE_BINARY_FILE, array($this, "serviceCreateBinaryFile"));
        $this->sc->registerService(self::APPEND_TEXT_FILE, array($this, "serviceAppendTextFile"));
        $this->sc->registerService(self::APPEND_BINARY_FILE, array($this, "serviceAppendBinaryFile"));
        $this->sc->registerService(self::READ_TEXT_FILE, array($this, "serviceReadTextFile"));
        $this->sc->registerService(self::READ_BINARY_FILE, array($this, "serviceReadBinaryFile"));
        $this->sc->registerService(self::DELETE_FILE, array($this, "serviceDeleteFile"));
        $this->sc->registerService(self::DELETE_FOLDER, array($this, "serviceDeleteFolder"));
        $this->sc->registerService(self::GET_FILE_PARTS, array($this, "serviceGetFileParts"));
    }


    public function serviceGetSubFolders($params)
    {
        return $this->filesystem . getSub(glob('*'), 'is_dir');
    }

    public function serviceGetFiles($params)
    {
        return $this->filesystem->getFiles($params->path);
    }


    public function serviceFileExists($params)
    {
        return $this->filesystem->fileExists($params->path);
    }

    public function serviceFolderExists($params)
    {
        return $this->filesystem->folderExists($params->path);
    }

    public function serviceCreateFolder($params)
    {
        $this->filesystem->createFolder($params->path);
    }

    public function serviceCopyFile($params)
    {
        $this->filesystem->copyFile($params->from, $params->to);
    }

    public function serviceCopyFolder($params)
    {
        $this->filesystem->copyFolder($params->from, $params->to);
    }

    public function serviceCreateTextFile($params)
    {
        $this->filesystem->writeTextFile($params->path, $params->content);
    }

    public function serviceCreateBinaryFile($params)
    {
        $this->filesystem->writeBinaryFile($params->path, $params->content);
    }

    public function serviceAppendTextFile($params)
    {
        $this->filesystem->writeTextFile($params->path, $params->content, true);
    }

    public function serviceAppendBinaryFile($params)
    {
        $this->filesystem->writeBinaryFile($params->path, $params->content, true);
    }

    public function serviceReadTextFile($params)
    {
        return $this->filesystem->readTextFile($params->path);
    }

    public function serviceReadBinaryFile($params)
    {
        return $this->filesystem->readBinaryFile($params->path);
    }

    public function serviceDeleteFile($params)
    {
        $this->filesystem->deleteFile($params->path);
    }

    public function serviceDeleteFolder($params)
    {
        $this->filesystem->deleteFolder($params->path);
    }

    public function serviceGetFileParts($params)
    {
        return $this->filesystem->getFileParts($params->path);
    }

}


