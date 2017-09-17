<?php
/**
 * Created by IntelliJ IDEA.
 * User: varadig
 * Date: 11/14/13
 * Time: 10:49 PM
 * To change this template use File | Settings | File Templates.
 */

namespace core\base;

use core\base\interfaces\IExecutable;

include_once "core/base/interfaces/IExecutable.php";

class CoreBaseParameterHolder implements IExecutable
{

    protected $params = array();

    public function addParam($name, $value)
    {
        $this->params[$name] = $value;
        return $this;
    }

    public function setParam($name, $value)
    {
        $this->params[$name] = $value;
        return $this;
    }

    public function addParams($params)
    {
        foreach ($params as $key => $params)
            $this->addParam($key, $params[$key]);

        return $this;
    }

    public function setParams($params)
    {

        $keys[] = array_keys($params);
        foreach ($keys as $key => $keys)
            $this->setParam($key, $params[$key]);
        return $this;
    }

    public function notify()
    {
    }

    public function execute()
    {
        return null;
    }

    public function send()
    {
    }
}
