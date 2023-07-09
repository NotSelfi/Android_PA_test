<?php

require_once "conf.inc.php";

function connectDB(){

    try{
        $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8",DB_USER,DB_PASSWORD);
        return $pdo;
    } catch(Exception $e){
        echo $e->getMessage();
    }

}