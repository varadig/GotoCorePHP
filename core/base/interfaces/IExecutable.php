<?php


/**
 * @author varadig
 */
namespace core\base\interfaces;
interface IExecutable
{
    public function addParam( $name, $value);

    public function addParams($params);

    public function setParam($name, $value);

    public function setParams($params);

    public function execute();

    public function notify();

    public function send();
}
