<?php
namespace core\data\parser\base;

include_once "core/base/CoreBaseClass";
use core\base\CoreBaseClass;

class CoreBaseParser extends CoreBaseClass
{
    public function CoreBaseParser()
    {
        parent::__construct();
    }

    public function parseFrom($data)
    {
        return [];
    }

    public function parseTo(array $data)
    {
        return "";
    }
}

