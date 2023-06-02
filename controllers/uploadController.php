<?php

class Upload extends Controller{
    function __construct(){
        parent::__construct();
    }

    function load($data){
        var_dump($data);

        http_response_code(201); 
        echo json_encode(array("message" => "cualquier cosa.".$data));
    }

    function render(){
        $this->view->datos = $this->model->getFiles();
        $this->view->title = 'Cargar Documentos';
        $this->view->render('upload/upload');
    }
}