<?php
/**
 * Created by IntelliJ IDEA.
 * User: varadig
 * Date: 2013.11.15.
 * Time: 14:06
 * To change this template use File | Settings | File Templates.
 */

namespace core\notification;


use core\base\CoreBaseClass;
use core\notification\CoreListener;
use core\notification\CoreNotification;

include_once "core/base/CoreBaseClass.php";
include_once "core/notification/CoreListener.php";
include_once "core/notification/CoreNotification.php";


class CoreNotificationContainer extends CoreBaseClass
{

    private $mapping = array();
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
        $this->sc->registerService(CoreListener::REGISTER_LISTENER, array($this, "registerListener"));
        $this->sc->registerService(CoreListener::REMOVE_LISTENER, array($this, "removeListener"));
        $this->sc->registerService(CoreNotification::CREATE_NOTIFICATION, array($this, "createNotification"));
    }

    public function registerListener($params)
    {
        $name = $params->name;
        $listener = $params->listener;

        if (!$this->hasNotification($name))
            $this->mapping[$name] = array();
            $this->mapping->$name = object();

        $listeners = $this->mapping[$name];
//        $listeners = &$this->mapping[$name];
        array_push($listeners, $listener);


    }

    public function removeListener($params)
    {
        $name = $params->name;

        $listeners[] = $this->getListenersOf($name);
        if (in_array($name, $listeners))
            unset($listeners[$name]);
    }

    public function createNotification($params)
    {
        $name = $params->name;
        $listeners = &$this->mapping[$name];

        return new CoreNotification($name, $listeners);
    }

    private function hasNotification($name)
    {
        return array_key_exists($name, $this->mapping);
    }

    private function getListenersOf($name)
    {

        if ($this->hasNotification($name))
            return $this->mapping[$name];
        else
            return array();
    }
}


