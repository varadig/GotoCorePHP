<?php
namespace core\logger;
/**
 * @author varadig
 */
include_once "core/logger/base/CoreBaseLogger.php";
use core\logger\base\CoreBaseLogger;

class CoreLoggerConsol extends CoreBaseLogger
{
    protected function addLogEntry($message)
    {
        var_dump($this->createEntryFrom($message));
    }

}
