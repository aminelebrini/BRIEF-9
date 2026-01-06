<?php

namespace data;

USE PDO;

USE PDOException;

class Data
{
    private static $instance = null;
    private $servername = 'my_mysql_new';
    private $serverpass = '123456';
    private $serverusername = 'root';
    private $port = '3306';
    private $db = 'my_read_up';
    private static $conn;

    private function __construct()
    {
        try{
            self::$conn = new PDO("mysql:host={$this->servername};port={$this->port};dbname={$this->db};charset=utf8", $this->serverusername, $this->serverpass);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $e){
    
            echo $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if(self::$instance === null)
        {
            self::$instance = new Data();
        }
        return self::$instance;
    }
    public function connection()
    {
        return self::$conn;
    }

}