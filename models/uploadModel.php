<?php

class UploadModel extends Model{

    function __construct(){
        parent::__construct();
    }

    function getFiles(){
        $data = [];
        $this->db->connect();
        $result = $this->db->getConnection()->query("SELECT * FROM `fileRegisters` ORDER BY dateCreated DESC;");
        
        if ($result != false){
            while ($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
        }
        
        $this->db->closeConnec();
        
        return $data;
    }

}

?>