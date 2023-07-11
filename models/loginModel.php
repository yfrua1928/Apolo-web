<?php

class LoginModel extends Model{

    function __construct(){
        parent::__construct();
        $this->getDataToken();
    }

    function validateLogin($user, $password) {
        $result = parent::sendData(login.$_SESSION['token'], array('user' => $user, 'password' => $password), "POST");
        if ( isset($result['id']) ){
            $_SESSION['name'] = $result['name'];
            $_SESSION['id'] = $result['id'];
            $_SESSION['user'] = $result['username'];
            $_SESSION['rol'] = $result['role'];
            return true;
        }else if(isset($result['error'])){
           return $result['error'];
        }else{
           return "500";
        }
    }
    
    function validateUser($id){
        include 'models/usersModel.php';
        $user = new UsersModel();
        return !empty($user->getUserForUsername($id));
    }

    function updateLogin($id){
        $data = array('id' =>  $_SESSION['id'], 'lastconnection' => date('Y-m-d H:i:s'));
        $result = parent::sendData(updateTime.$_SESSION['token'], $data, "PUT");
        if (!isset($result["Status"]) || $result["Status"] !== "0001" ){
            return false;
        }
        return true;
    }

    function getDataToken(){
        $result = parent::getData(token);
        if(isset($result["accessToken"])){
            $_SESSION['token']=$result["accessToken"];
        }
        return;
    }

}