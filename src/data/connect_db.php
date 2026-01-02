<?php

$servername = 'my_mysql';
$serverpass = '123456';
$serverusername = 'root';
$port = '3306';
$db = 'my_read_up';

try{
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$db;charset=utf8", $serverusername, $serverpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

}catch(Exception $e){
    
   echo $e->getMessage();
}

