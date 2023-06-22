<?php 

class Waiting extends Controller{

    function __construct(){
        parent::__construct();
    }

    function render(){
        $this->view->pathJs = 'waiting.js';
        $this->view->institutions = $this->model->getInstitutions();
        $this->view->datos = $this->model->getDatos();
        $this->view->title = 'Lista de Espera';
        $this->view->render('waiting/waiting');
    }

}

