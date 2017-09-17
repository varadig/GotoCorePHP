<?php
/**
 * Created by IntelliJ IDEA.
 * User: varadig
 * Date: 2013.11.15.
 * Time: 14:11
 * To change this template use File | Settings | File Templates.
 */

namespace core\base;

use core\notification\CoreListener;

class CoreBaseSender extends CoreBaseParameterHolder
{

    protected $name;

    protected $collection=[];

    public function __construct($name,$collection)
    {
        $this->name = $name;
        $this->collection = $collection;
    }

}

