<?php
/**
 * Created by IntelliJ IDEA.
 * User: varadig
 * Date: 11/14/13
 * Time: 10:55 PM
 * To change this template use File | Settings | File Templates.
 */

namespace core\base;

include_once "core/base/CoreBaseParameterHolder.php";

class CoreBaseFunctionWrapper extends CoreBaseParameterHolder
{
    protected $name = "";

    protected $reference;


    public function __construct($name, $reference)
    {
        $this->name = $name;
        $this->reference = $reference;
    }

    public function call()
    {
        return call_user_func($this->reference, (object)$this->params);
    }

    public function has($reference)
    {

        return ($this->reference == $reference);
    }

    public function _clone()
    {
        return null;
    }
}