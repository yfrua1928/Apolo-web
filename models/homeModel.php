<?php

class HomeModel extends Model{

    function __construct(){
        parent::__construct();
    }
    function SmsXHospital(){
        $data = [];
        $this->db->connect();
        $mes=date('m');
        $anio=date('Y');
        $result = $this->db->getConnection()->query("select (select count(*)  FROM messages where (dateCreate BETWEEN '".$anio."-".$mes."-01' AND '".$anio."-".$mes."-07')) as S1Total ,
        (select count(*)  FROM messages where (dateCreate BETWEEN '".$anio."-".$mes."-01' AND '".$anio."-".$mes."-07') and idInstitute='890904646' ) as S1HGM ,
        (select count(*) FROM messages where (dateCreate BETWEEN '".$anio."-".$mes."-01' AND '".$anio."-".$mes."-07') and idInstitute='890905177' or idInstitute='8909051772') as S1HLM,
        (select count(*)FROM messages where (dateCreate BETWEEN '".$anio."-".$mes."-01' AND '".$anio."-".$mes."-07') and idInstitute='900625317') as S1HCIM ,
        (select count(*) FROM messages where (dateCreate BETWEEN '".$anio."-".$mes."-01' AND '".$anio."-".$mes."-07') and idInstitute='900425272' ) as S1COX ,
        (select count(*) FROM messages where (dateCreate BETWEEN '".$anio."-".$mes."-01' AND '".$anio."-".$mes."-07') and idInstitute='800123106' ) as S1HVDD,
        (select count(*)  FROM messages where (dateCreate BETWEEN '".$anio."-".$mes."-08' AND '".$anio."-".$mes."-14')) as S2Total ,
        (select count(*)  FROM messages where (dateCreate BETWEEN '".$anio."-".$mes."-08' AND '".$anio."-".$mes."-14') and idInstitute='890904646' ) as S2HGM ,
        (select count(*) FROM messages where (dateCreate BETWEEN '".$anio."-".$mes."-08' AND '".$anio."-".$mes."-14') and idInstitute='890905177' or idInstitute='8909051772') as S2HLM,
        (select count(*)FROM messages where (dateCreate BETWEEN '".$anio."-".$mes."-08' AND '".$anio."-".$mes."-14') and idInstitute='900625317') as S2HCIM ,
        (select count(*) FROM messages where (dateCreate BETWEEN '".$anio."-".$mes."-08' AND '".$anio."-".$mes."-14') and idInstitute='900425272' ) as S2COX ,
        (select count(*) FROM messages where (dateCreate BETWEEN '".$anio."-".$mes."-08' AND '".$anio."-".$mes."-14') and idInstitute='800123106' ) as S2HVDD ,
        (select count(*)  FROM messages where (dateCreate BETWEEN '".$anio."-".$mes."-15' AND '".$anio."-".$mes."-21')) as S3Total ,
        (select count(*)  FROM messages where (dateCreate BETWEEN '".$anio."-".$mes."-15' AND '".$anio."-".$mes."-21') and idInstitute='890904646' ) as S3HGM ,
        (select count(*) FROM messages where (dateCreate BETWEEN '".$anio."-".$mes."-15' AND '".$anio."-".$mes."-21') and idInstitute='890905177' or idInstitute='8909051772') as S3HLM,
        (select count(*)FROM messages where (dateCreate BETWEEN '".$anio."-".$mes."-15' AND '".$anio."-".$mes."-21') and idInstitute='900625317') as S3HCIM ,
        (select count(*) FROM messages where (dateCreate BETWEEN '".$anio."-".$mes."-15' AND '".$anio."-".$mes."-21') and idInstitute='900425272' ) as S3COX ,
        (select count(*) FROM messages where (dateCreate BETWEEN '".$anio."-".$mes."-15' AND '".$anio."-".$mes."-21') and idInstitute='800123106' ) as S3HVDD ,
        (select count(*)  FROM messages where (dateCreate BETWEEN '".$anio."-".$mes."-22' AND '".$anio."-".$mes."-30')) as S4Total ,
        (select count(*)  FROM messages where (dateCreate BETWEEN '".$anio."-".$mes."-22' AND '".$anio."-".$mes."-30') and idInstitute='890904646' ) as S4HGM ,
        (select count(*) FROM messages where (dateCreate BETWEEN '".$anio."-".$mes."-22' AND '".$anio."-".$mes."-30') and idInstitute='890905177' or idInstitute='8909051772') as S4HLM,
        (select count(*)FROM messages where (dateCreate BETWEEN '".$anio."-".$mes."-22' AND '".$anio."-".$mes."-30') and idInstitute='900625317') as S4HCIM ,
        (select count(*) FROM messages where (dateCreate BETWEEN '".$anio."-".$mes."-22' AND '".$anio."-".$mes."-30') and idInstitute='900425272' ) as S4COX ,
        (select count(*) FROM messages where (dateCreate BETWEEN '".$anio."-".$mes."-22' AND '".$anio."-".$mes."-30') and idInstitute='800123106' ) as S4HVDD  
        from  messages  limit 1;");

        // var_dump($v);
        if ($result != false){
            while ($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
        }
        
        $this->db->closeConnec();
        
        return $data;
    }function ConfirmacionXHospital(){
        $data = [];
        $this->db->connect();
        $result = $this->db->getConnection()->query("select (select count(*)  FROM messages where Type='c' and status in (1,2,3,4,5,6,7)) as Total ,
        (select count(*)  FROM messages where type='c' and idInstitute='890904646' ) as HGM ,
        (select count(*) FROM messages where type='c' and idInstitute='890905177' or idInstitute='8909051772')  as HLM,
        (select count(*)FROM messages where type='c' and idInstitute='900625317')  as HCIM ,
        (select count(*) FROM messages where type='c' and idInstitute='900425272' ) as COX ,
        (select count(*) FROM messages where type='c' and idInstitute='800123106' ) as HVDD 
        from  messages  limit 1;");
        
        if ($result != false){
            while ($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
        }
        
        $this->db->closeConnec();
        
        return $data;
    }
    function AgendamientoXHospital(){
        $data = [];
        $this->db->connect();
        $result = $this->db->getConnection()->query("select (select count(*)  FROM messages where Type='ad' and status in (1,2,3,4,5,6,7)) as Total ,
        (select count(*)  FROM messages where type='ad' and idInstitute='890904646' ) as HGM ,
        (select count(*) FROM messages where type='ad' and idInstitute='890905177' or idInstitute='8909051772')  as HLM,
        (select count(*)FROM messages where type='ad' and idInstitute='900625317')  as HCIM ,
        (select count(*) FROM messages where type='ad' and idInstitute='900425272' ) as COX ,
        (select count(*) FROM messages where type='ad' and idInstitute='800123106' ) as HVDD 
        from  messages  limit 1;");
        
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
        $result = $this->db->getConnection()->query("select (select count(*)  FROM messages where Type='c' and status in (1,2,3,4,5,6,7)) as Total ,
        (select count(*) FROM messages where Type='c' and status=2)  as Confirmados,
        (select count(*)FROM messages where Type='c' and status in (3))  as Cancelados ,
        (select count(*)FROM messages where Type='c' and status in (7,5,6,4))  as CanceladosXnoRespuesta ,
        (select count(*)FROM messages where Type='c' and status in (0))  as CanceladosXenvio ,
        (select count(*) FROM messages where Type='c' and status in (1)) as NoRespuestas 
        from  messages  limit 1;");
        
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
       
        $result = $this->db->getConnection()->query("select (select count(*)  FROM messages where Type='and') as Total ,
        (select count(*)  FROM messages where Type='and' and idInstitute='890904646' ) as HGM ,
        (select count(*) FROM messages where Type='and' and (idInstitute='890905177' or idInstitute='8909051772' or idInstitute='0'))  as HLM,
        (select count(*)FROM messages where Type='and' and idInstitute='900625317')  as HCIM ,
        (select count(*) FROM messages where Type='and' and idInstitute='900425272' ) as COX ,
        (select count(*) FROM messages where Type='and' and idInstitute='800123106' ) as HVDD 
        from  messages  limit 1;");
        
        if ($result != false){
            while ($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
        }
        
        $this->db->closeConnec();
        
        return $data;
    }
    function getResultListaEspera(){
        $data = [];
        $this->db->connect();
        $result = $this->db->getConnection()->query("select (select count(*)  FROM waitingList) as Total,
        (select count(*)  FROM waitingList where idInstitution='890904646' ) as HGM ,
        (select count(*) FROM waitingList where idInstitution='890905177' or idInstitution='8909051772' or idInstitution='0')  as HLM,
        (select count(*)FROM waitingList where idInstitution='900625317')  as HCIM ,
        (select count(*) FROM waitingList where idInstitution='900425272' ) as COX ,
        (select count(*) FROM waitingList where idInstitution='800123106' ) as HVDD 
        from  waitingList  limit 1;");
        
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
        $result = $this->db->getConnection()->query("select (select count(*)  FROM messages where Type='ad' and status in (1,2,3,4,5,6,7)) as Total ,
        (select count(*) FROM messages where Type='ad' and status=2)  as Confirmados,
        (select count(*)FROM messages where Type='ad' and status in (3))  as Cancelados ,
        (select count(*)FROM messages where Type='ad' and status in (7,5,6,4))  as CanceladosXnoRespuesta ,
        (select count(*)FROM messages where Type='ad' and status in (0))  as CanceladosXenvio ,
        (select count(*) FROM messages where Type='ad' and status in (1)) as NoRespuestas 
        from  messages  limit 1;");
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