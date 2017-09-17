<?php
namespace core\data\parser;

use core\base\CoreBaseClass;

include_once "core/base/CoreBaseClass.php";


class CoreParser extends CoreBaseClass
{

    const PARSE_FROM_JSON = 'parse.from.json';
    const PARSE_TO_JSON = 'parse.to.json';


    private static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance))
            self:: $instance = new self;
        return self::$instance;
    }

    public function CoreParser()
    {
        parent::__construct();
        $this->sc->registerService(PARSE_FROM_JSON, this . serviceFromJson);
        $this->sc->registerService(PARSE_TO_JSON, this . serviceToJson);
    }


    public function serviceFromJson(array $params)
    {
        return json_decode($params->data);
    }

    public function serviceToJson(array $params)
    {

        return json_encode($params->dara);
    }
}




