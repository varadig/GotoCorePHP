<?php
/**
 * Created by IntelliJ IDEA.
 * User: varadig
 * Date: 11/14/13
 * Time: 10:47 PM
 * To change this template use File | Settings | File Templates.
 */

namespace core\service;

include_once "CoreService.php";

class CoreServiceContainer
{
    private $mapping = array();
    private static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance))
            self::$instance = new self;
        return self::$instance;
    }

    private final function __construct()
    {

        static::init();
    }

    protected function init()
    {
    }

    public function registerService($name, $reference)
    {

        $this->mapping[$name] = $reference;
    }

    public function updateService($name, $reference)
    {
        $this->mapping[$name] = $reference;
    }

    public function removeService($name)
    {
        unset($this->mapping[$name]);
    }

    public function getService($name)
    {
        $reference = $this->mapping[$name];
        $service = new CoreService($name, $reference);
        return $service;
    }

    public function hasService($name)
    {
        return (array_key_exists($name, $this->mapping));
    }
}