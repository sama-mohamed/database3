<?php 
$dsn = "mysql:host=localhost;dbname=students";
$user = 'root';
$pass = '';

try{
    $con = new PDO($dsn,$user,$pass);
}catch(PDOException $ex){
    echo "error". $ex->getMessage();
}