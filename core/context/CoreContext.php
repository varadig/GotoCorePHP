<?php
namespace core\context;

  include_once  "core/base/CoreBaseParameterHolder.php";
use core\base\CoreBaseParameterHolder;
use core\service\CoreServiceContainer;

class CoreContext extends CoreBaseParameterHolder
{
    public static $instance;
    public $sc;


    public function __construct()
    {
        $this->sc = CoreServiceContainer::getInstance();
    }


    public static function getInstance()
    {
        if (!isset(self::$instance))
            self::$instance = new self;
        return self::$instance;
    }

    public function getParam($name)
    {
        return $this->params[$name];
    }

    public
    function setParamAndNotify($name, $value)
    {
        $this->params[$name] = $value;
        $notification = $this->sc->getService("create.notification")->addParam("name", name)->execute();
        $notification->send();
        return $this;
    }
}

?>
