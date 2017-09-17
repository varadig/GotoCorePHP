<?php
/**
 * Created by IntelliJ IDEA.
 * User: varadig
 * Date: 11/17/13
 * Time: 1:06 PM
 * To change this template use File | Settings | File Templates.
 */

namespace core\database\base;


class CoreBaseConnection
{
    private $connection;

    public function __construct($db, $host, $user, $password)
    {
        $this->connection = mysql_connect($host, $user, $password) or die(mysql_error());
        mysql_select_db($db, $this->connection);
        mysql_query("SET NAMES 'utf8'");
    }

    public function query($string)
    {
        if ($string) {
            $results = array();
            $mysql_query = mysql_query($string) or die(mysql_error());
            while ($result = mysql_fetch_array($mysql_query))
                $result[] = $result;
            return $results;
        } else {
            $error[] = "Mysql select query error";
            return false;
        }
    }

    public function update($query, $limit)
    {
        if ($limit)
            $limit = "limit 1";
        else
            $limit = '';

        if($query['where'])
    }
}