<?php
/**
 * Created by IntelliJ IDEA.
 * User: varadig
 * Date: 2013.11.15.
 * Time: 14:09
 * To change this template use File | Settings | File Templates.
 */

namespace core\notification;

use core\base\CoreBaseFunctionWrapper;

class CoreListener extends CoreBaseFunctionWrapper
{

    const REGISTER_LISTENER = "register.listener";
    const REMOVE_LISTENER = "remove.listener";
    const LISTENER = "listener";
    const NAME = "name";

    public function __construct($name, $reference)
    {
        parent::__construct($name, $reference);
    }

    public function notify()
    {
        $this->call();
    }




}