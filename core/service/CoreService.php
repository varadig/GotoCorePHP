<?php
/**
 * Created by IntelliJ IDEA.
 * User: varadig
 * Date: 11/14/13
 * Time: 10:54 PM
 * To change this template use File | Settings | File Templates.
 */

namespace core\service;


include_once  "core/base/CoreBaseFunctionWrapper.php";
use core\base\CoreBaseFunctionWrapper;

class CoreService extends CoreBaseFunctionWrapper
{
    public function __construct($name, $reference)
    {
        parent::__construct($name, $reference);
    }

    public function execute()
    {
        return parent::call();
    }

    public function _clone()
    {
        $service = new CoreService($this->name, $this->reference);
        $service->addParams($this->params);
        return service;
    }
}