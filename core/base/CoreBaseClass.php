<?php
/**
 * Created by IntelliJ IDEA.
 * User: varadig
 * Date: 11/14/13
 * Time: 10:44 PM
 * To change this template use File | Settings | File Templates.
 */

namespace core\base;

use core\service\CoreServiceContainer;

include_once "core/base/CoreBaseClassFactory.php";

class CoreBaseClass
{
    public $sc;

    public $context;

    public $callbacks = array();

    protected static $nameIndex = 0;

    protected $namePrefix = "object";

    private $_name;

    public function __construct()
    {
        $this->_name = $this->generateName();

        CoreBaseClassFactory::construct($this);
    }

    public function serviceAddCallback($params)
    {
        CoreBaseClassFactory::serviceAddCallback($this, $params);
    }

    public function serviceAddCallbacks($params)
    {
        CoreBaseClassFactory::serviceAddCallbacks($this, $params);
    }

    public function createCallBack($group)
    {
        return CoreBaseClassFactory::createCallBack($this, $group);
    }

    protected function log($message)
    {
        CoreBaseClassFactory::log($this, $message);
    }

    public function __get($property)
    {
        if (property_exists($this, $property))
            return $this->$property;
    }

    private function generateName()
    {
        return ($this->namePrefix . CoreBaseClass::$nameIndex++);
    }
}