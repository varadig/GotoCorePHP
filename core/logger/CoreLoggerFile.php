<?php
/**
 * Created by IntelliJ IDEA.
 * User: varadig
 * Date: 2013.11.17.
 * Time: 10:22
 * To change this template use File | Settings | File Templates.
 */

namespace core\logger;

use core\filesystem\CoreFileSystem;
use core\logger\base\CoreBaseLogger;
use core\utils\CoreUtils;

class CoreLoggerFile extends CoreBaseLogger
{
    const PATH = "log.file.path";
    const ARCHIVE = "archive.log.file";
    const READ = "read.log.file";

    public function __construct()
    {
        parent::__construct();
        $this->sc->registerService(self::ARCHIVE, array($this, "serviceArchiveLogFile"));
        $this->sc->registerService(self::READ, array($this, "serviceReadLogFile"));
    }

    public function serviceArchiveLogFile($params)
    {
        $parts = $this->sc->getService(CoreFileSystem::GET_FILE_PARTS)->addParam(CoreFileSystem::PATH, $params->path)->execute();

        $fullPath = $parts->dirname . "/" . $parts->basename . "/" + $parts->extension;
        $archivePath = $parts->dirname . "/" . $parts->basename . "/" . CoreUtils::getTimeStamp() . "/" . $parts->extension;

        $this->sc->getService(CoreFileSystem::COPY_FILE)->addParam(CoreFileSystem::FROM, $fullPath)->addParam(CoreFileSystem::TO, $archivePath)->execute();
        $this->sc->getService(CoreFileSystem::DELETE_FILE)->addParam(CoreFileSystem::PATH, $parts->path . "/" . $parts->filename . "/" . $parts->extension)->execute();

        $this->log("log file is arcivated");
    }

    public function serviceReadLogFile($params)
    {
        $path = $this->context->getParam(self::PATH);
        return $this->sc->getService(CoreFileSystem::READ_TEXT_FILE)->addParam(CoreFileSystem::PATH, $path)->execute();
    }

    protected function addLogEntry($message)
    {
        $path = $this->context->getParam(self::PATH);

        $this->sc->getService(CoreFileSystem::APPEND_TEXT_FILE)
            ->addParam(CoreFileSystem::PATH, $path)
            ->addParam(CoreFileSystem::CONTENT, $this->createEntryFrom($message))
            ->execute();
    }

}
