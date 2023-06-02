<?php
class database{
    public function __construct(){
        require_once "config/connection.php";
    }

    public function executeQuery($query){
        $connection = connection::getInstance();
        $stmt = $connection->query($query);

        return $stmt;
    }
}