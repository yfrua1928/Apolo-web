<?php

class HomeModel extends Model{

    function __construct(){
        parent::__construct();
    }
    function getResultXHospital(){
        $data = [];
        $this->db->connect();
        $result = $this->db->getConnection()->query("select (select count(*)  FROM appointment_booking.messages where idInstitute='890904646' ) as HGM ,
        (select count(*) FROM appointment_booking.messages where idInstitute='890905177' or idInstitute='8909051772')  as HLM,
        (select count(*)FROM appointment_booking.messages where idInstitute='900625317')  as HCIM ,
        (select count(*) FROM appointment_booking.messages where idInstitute='900425272' ) as COX 
        from  appointment_booking.messages  limit 1;");
        
        if ($result != false){
            while ($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
        }
        
        $this->db->closeConnec();
        
        return $data;
    }
    function getResultC(){
        $data = [];
        $this->db->connect();
        $result = $this->db->getConnection()->query("select (select count(*)  FROM appointment_booking.messages where Type='c') as Total ,
        (select count(*) FROM appointment_booking.messages where Type='c' and status=2)  as Confirmados,
        (select count(*)FROM appointment_booking.messages where Type='c' and status=3)  as Cancelados ,
        (select count(*) FROM appointment_booking.messages where Type='c' and status in (7,5)) as NoRespuestas 
        from  appointment_booking.messages  limit 1;");
        
        if ($result != false){
            while ($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
        }
        
        $this->db->closeConnec();
        
        return $data;
    }
    function getResultAnd(){
        $data = [];
        $this->db->connect();
        $result = $this->db->getConnection()->query("select (select count(*)  FROM appointment_booking.messages where Type='and') as Total ,
        (select count(*) FROM appointment_booking.messages where Type='and' and status=2)  as Confirmados,
        (select count(*)FROM appointment_booking.messages where Type='and' and status=3)  as Cancelados ,
        (select count(*) FROM appointment_booking.messages where Type='and' and status in (7,5)) as NoRespuestas 
        from  appointment_booking.messages  limit 1;");
        
        if ($result != false){
            while ($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
        }
        
        $this->db->closeConnec();
        
        return $data;
    }
    function getResultAd(){
        $data = [];
        $this->db->connect();
        $result = $this->db->getConnection()->query("select (select count(*)  FROM appointment_booking.messages where Type='ad') as Total ,
        (select count(*) FROM appointment_booking.messages where Type='ad' and status=2)  as Confirmados,
        (select count(*)FROM appointment_booking.messages where Type='ad' and status=3)  as Cancelados ,
        (select count(*) FROM appointment_booking.messages where Type='ad' and status in (7,5)) as NoRespuestas 
        from  appointment_booking.messages  limit 1;");

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