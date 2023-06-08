<?php

class WaitingModel extends Model{

    function __construct(){
        parent::__construct();
    }

    function getInstitutions(){
        $data = [];
        $query = "SELECT `idInstitution`, `name` FROM institutes where status = 0";
        $this->db->connect();
        $result = $this->db->getConnection()->query($query);

        while ($row = $result->fetch_assoc()) {
            array_push($data, $row);
        }
        $this->db->closeConnec();
        return $data;
    }

    function getDatos(){
        $data = [];
        $query = "SELECT * FROM waitingList ";
        $this->db->connect();
        $result = $this->db->getConnection()->query($query);

        while ($row = $result->fetch_assoc()) {
            array_push($data, $row);
        }
        $this->db->closeConnec();
        return $data;
    }

}