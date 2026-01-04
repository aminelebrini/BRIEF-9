<?php

namespace data;

class Data
{
    private $servername = 'my_mysql';
    private $serverpass = '123456';
    private $serverusername = 'root';
    private $port = '3306';
    private $db = 'my_read_up';
    private $conn;

    public function connection()
    {
        $this->conn = null;

        try{
        $this->conn = new \PDO("mysql:host=$this->servername;port=$this->port;dbname=$this->db;charset=utf8", $this->serverusername, $this->serverpass);

        $this->conn->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);

        }catch(\PDOException $e){
    
            echo $e->getMessage();
        }

        return $this->conn;
    }

}