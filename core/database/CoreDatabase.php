<?php
/**
 * Created by IntelliJ IDEA.
 * User: varadig
 * Date: 11/17/13
 * Time: 12:58 PM
 * To change this template use File | Settings | File Templates.
 */

namespace core\database;


use core\base\CoreBaseClass;
use core\database\base\CoreBaseConnection;

class CoreDatabase extends CoreBaseClass
{
    private static $instance;
    private $connections = array();

    public static function getInstance()
    {
        if (!isset(self::$instance))
            self::$instance = new self;
        return self::$instance;
    }

    public function __construct()
    {
        parent::__construct();
        $this->sc->registarService(self::CONNECT, array($this, "serviceConnect"));
        $this->sc->registarService(self::QUERY, array($this, "serviceQuery"));
    }

    public function serviceConnect($params)
    {
        $this->connections[$params->db] = new CoreBaseConnection($params->db, $params->host, $params->user, $params->password);
    }

    public function serviceConnect($params)
    {
        $connection = $this->connections[$params->db];
        $connection->connect
        $this->connections[$params->db] = new CoreBaseConnection($params->db, $params->host, $params->user, $params->password);
    }
}