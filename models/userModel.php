<?php
class userModel{
    private $database;

    public function __construct(){
        require_once "database.php";

        $this->database = new database();
    }

    public function getUsers(){
        $query = "SELECT * FROM users";
        $result = $this->database->executeQuery($query);

        return $result;
    }

    public function getUser($params){
        switch($params["option"]){
            case "login":
                $query = "SELECT * FROM users WHERE username = '".$params["username"]."' AND password = '".$params["password"]."'";
            break;
        }

        $result = $this->database->executeQuery($query);

        return $result;
    }
}