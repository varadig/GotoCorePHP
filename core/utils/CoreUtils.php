<?php
/**
 * Created by IntelliJ IDEA.
 * User: varadig
 * Date: 11/17/13
 * Time: 11:40 AM
 * To change this template use File | Settings | File Templates.
 */

namespace utils;


class CoreUtils {

    public static function getTimeStamp()
    {
        $date = date_create();
        return date_format($date, 'U = Y-m-d H:i:s');
    }
}