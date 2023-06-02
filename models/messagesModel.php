<?php
class messagesModel{
    private $database;

    public function __construct(){
        require_once "database.php";

        $this->database = new database();
    }

    public function getMessages(){
        $query = "SELECT * FROM messages";
        $result = $this->database->executeQuery($query);

        return $result;
    }

    public function setMessages($params){
        $query = "INSERT INTO messages (`cellPhone`, `typeDocument`, `document`, `name`, `idInstitute`,
        `dateAppointment`, `appointmentHour`, `speciality`, `status`)
        VALUES ('".$params["cellPhone"]."', '".$params["typeDocument"]."', '".$params["document"]."', 
        '".$params["name"]."', ".$params["idInstitute"].", '".$params["dateAppointment"]."', 
        '".$params["appointmentHour"]."', '".$params["speciality"]."', ".$params["status"].")";
        $result = $this->database->executeQuery($query);

        return $result;
    }
}