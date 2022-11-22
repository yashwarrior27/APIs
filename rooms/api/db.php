<?php
header('Content-Type:application/json');
header('Access-Control-Allow-Origin:*');

function connect(){
    $hostname="localhost";
    $dbname="rooms_mang";
    $username="root";
    $password="";
    $dsn="mysql:host=$hostname;dbname=$dbname";
    try{
      $conn= new PDO($dsn,$username,$password);
       return $conn;
    }
    catch(Exception $e){

     echo $e->getMessage();

    }

};

?>