<?php
namespace App\Helper;

class MyHelper{
    public static function readConfigDB(){
        $ini = parse_ini_file("../config.ini", true);
        return array($ini['db']['host'], $ini['db']['user'], $ini['db']['pwd'], $ini['db']['dbname']);
    }
}

?>