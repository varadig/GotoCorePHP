<?php
namespace core\base;

class CoreCallback extends CoreBaseSender
{
    const GROUP = 'group';
    const CALLBACK = 'callback';
    const CALLBACKS = 'callbacks';

    public function __construct(string $name, array $collection)
    {
        parent::__construct($name, $collection);
    }

    public function send()
    {
        foreach ($this->collection as $service) {
            $service->setParams($this->params)->execute();
        }
    }
}

?>