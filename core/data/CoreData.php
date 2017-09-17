<?php
namespace core\data;
include_once "core/baseCoreBaseClass.php";
class CoreData extends CoreBaseClass
{

    const LOAD_DATA_FROM = 'save.data.to';
    const SAVE_DATA_TO = 'load.data.from';
    private static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance))
            self::$instance = new self;
        return self::$instance;
    }

    public function CoreData()
    {
        CoreParser . getInstance();
        $this->sc->registerService(LOAD_DATA_FROM, array($this, "serviceLoadDataFrom"));
        $this->sc->registerService(SAVE_DATA_TO, array($this, "serviceSaveDataTo"));
    }


    private function serviceLoadDataFrom(array $params)
    {
        $path = $params["path"] . "." . $this->context->getParam("data.type");
        $data = $this->sc->getService("read.text.file")->addParam("path", $path)->execute();
        $result = (array)$this->sc->getService("parse.from." . $this->context->getParam("data.type"))->addParam("data", $data)->execute();
        return (array)$result;
    }

    private
    function serviceSaveDataTo(array $params)
    {
        $path = $params["path"] . "." . $this->context->getParam("data.type");

        $content = $this->sc->getService("parse.to." . $this->context->getParam("data.type"))->addParam("data", $params["data"])->execute();

        $this->sc->getService("create.text.file")->addParam("path", $path)->addParam("content", $content)->execute();
    }
}

?>


