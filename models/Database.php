<?php
namespace models;
class Database {
    private static $instance = null;

    private $connection;
   

    private function __construct(){
        $config = require_once './config.php';
        $host = DB_HOST;
                $user = DB_USER;
        $pass = DB_PASS;
        $name = DB_NAME;
         $charset = 'utf8';

        $dsn = "mysql:host=$host;dbname=$name";
      
       $this->connection = new \PDO($dsn, $user, $pass);
        $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
       
       
    }

    public static function getInstance(){
        if(!isset( self::$instance)){
            self::$instance = new self();
           
        }
         return self::$instance;
    }
    public  function getConnection(){
        return $this->connection;
    }
}