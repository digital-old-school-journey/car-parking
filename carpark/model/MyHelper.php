<?php
namespace App\Helper;
use \PDO;
class MyHelper{
    public static function createConnection(){
        $ini = parse_ini_file("config.ini", true);
         $host = $ini['db']['host'];
         $user = $ini['db']['user'];
         $pwd = $ini['db']['pwd'];
         $dbname = $ini['db']['dbname'];
         $connection = new PDO(
            "mysql:host=$host;dbname=$dbname",
            $user,
            $pwd
        );
        $connection->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
        $connection->exec("SET time_zone='+7:00';");
        return $connection;
    }
}

?>