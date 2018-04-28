<?php
namespace classes\util;
use classes\util\Config;
include config::getApplicationRoot().'/public/includes/password.php';
use mysqli;

class DBUtil
{
    public static function getConnection(){
        $config=Config::getConfig();
        $conn = new mysqli($config->mysqlServer, $config->mysqlUser, $config->mysqlPassword,$config->mysqlDB);
        return $conn;
    }
}

