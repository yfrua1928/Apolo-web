<?php

class DownloadModel extends Model{

    function __construct(){
        parent::__construct();
    }

    function getFiles(){
        $data = [];
        $this->db->connect();
        $result = $this->db->getConnection()->query("SELECT fr.idFile, fr.dateCreated, fr.name, u.name as userCreated FROM fileRegisters as fr INNER JOIN users as u on fr.userCreated = u.id ORDER BY dateCreated DESC;");
        
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