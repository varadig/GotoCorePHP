<?php
/**
 * Created by IntelliJ IDEA.
 * User: varadig
 * Date: 2013.11.17.
 * Time: 9:53
 * To change this template use File | Settings | File Templates.
 */

namespace core\logger;

use core\base\CoreBaseClass;

include_once "core/base/CoreBaseClass.php";

class CoreLogger extends CoreBaseClass
{
    private $logger;
    const LOGGER_LOG = "logger.log";
    const MESSAGE = "message";

    private static $instance;


    public static function getInstance($logger)
    {
        if (!isset(self::$instance))
            self::$instance = new self($logger);
        return self::$instance;
    }

    public function __construct($logger)
    {
        parent::__construct();
        $this->logger = $logger;
        $this->sc->registerService(self::LOGGER_LOG, array($this, "serviceLog"));
    }

    public function serviceLog($params)
    {
        $this->logger->addLog($params->message);
    }
}

