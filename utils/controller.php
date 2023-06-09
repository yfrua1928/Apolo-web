<?php

class Controller{

    public $view;
    public $model;

    function __construct() {     
        $this->view = new View();
    }

    function loadModel($model) {
        
        $url = path.'models/'.$model.'Model.php';
        // $url = '/var/www/html/apolo/models/'.$model.'Model.php';
        
        if(file_exists($url)){
            require $url;
            $modelName = $model.'Model';
            $this->model = new $modelName();
        }
        
    }
}

?>