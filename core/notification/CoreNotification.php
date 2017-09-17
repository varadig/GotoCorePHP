<?php
/**
 * Created by IntelliJ IDEA.
 * User: varadig
 * Date: 2013.11.15.
 * Time: 14:10
 * To change this template use File | Settings | File Templates.
 */

namespace core\notification;


use core\base\CoreBaseSender;

include_once "core/base/interfaces/IExecutable.php";
include_once "core/base/CoreBaseSender.php";

class CoreNotification extends CoreBaseSender
{
    const CREATE_NOTIFICATION = "create.notification";
    const NAME = "name";

    public function __construct($name, $collection)
    {
        parent::__construct($name, $collection);
    }

    public function send()
    {
        foreach ($this->collection as $listener)
            $listener->setParams($this->params)->notify();
    }
}

