<?php
/**
 * Created by IntelliJ IDEA.
 * User: varadig
 * Date: 11/17/13
 * Time: 11:43 AM
 * To change this template use File | Settings | File Templates.
 */

namespace core\logger\base;

use core\base\CoreBaseClass;
use utils\CoreUtils;

include_once "core/base/CoreBaseClass.php";
include_once "core/utils/CoreUtils.php";

class CoreBaseLogger extends CoreBaseClass
{
    protected $br = "\n";

    public function addLog($message)
    {
        switch (gettype($message)) {
            case "string":
                $this->addLogEntry($message);
                break;
            case "array":
                $this->addLogEntries($message);
                break;
        }
    }

    protected function addLogEntry($message)
    {
    }

    protected function addLogEntries($messages)
    {
        foreach ($messages as $message) {
            if (gettype($message) == "array")
                $this->addLogEntries($message);
            else if (gettype($message) == "string")
                $this->addLogEntry($message);
        }
    }

    protected function createEntryFrom($message)
    {
        return (CoreUtils::getTimeStamp() . " ----> " . $message . $this->br);
    }
}

