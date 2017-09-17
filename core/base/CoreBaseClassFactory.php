<?php
namespace core\base;


use core\context\CoreContext;
use core\logger\CoreLogger;
use core\service\CoreServiceContainer;

include_once "core/service/CoreServiceContainer.php";
include_once "core/context/CoreContext.php";

class CoreBaseClassFactory
{
    public static function construct($_instance)
    {
        $_instance->sc = CoreServiceContainer::getInstance();
        $_instance->context = CoreContext::getInstance();


        $_instance->sc->registerService($_instance->name + ".add.callback", $_instance->serviceAddCallback);
        $_instance->sc->registerService($_instance->name + ".add.callbacks", $_instance->serviceAddCallbacks);
    }

    public static function serviceAddCallback($_instance, $params)
    {
        $group = $params["group"];
        $callback = $params["callback"];

        CoreBaseClassFactory::addCallback($_instance, $group, $callback);
    }

    public static function serviceAddCallbacks($_instance, $params)
    {
        $group = $params["group"];
        $callbacks = $params["callbacks"];

        foreach ($callbacks as $callback)
            CoreBaseClassFactory . addCallback($_instance, $group, $callback);
    }

    public static function createCallBack($_instance, $group)
    {
        return new CoreCallback($group, $_instance->callbacks[$group]);
    }

    public static function addCallback($_instance, $group, $callback)
    {
        if ($_instance->callbacks[$group] == null)
            $_instance->callbacks[$group] = array();
        array_push($_instance->callbacks, $callback);
    }

    public static function log($_instance, $message)
    {
        if ($_instance->sc->hasService(CoreLogger::LOGGER_LOG)) {
            $_instance->sc->getService(CoreLogger::LOGGER_LOG)->addParam(CoreLogger::MESSAGE, $message)->execute();
        }
    }
}

?>