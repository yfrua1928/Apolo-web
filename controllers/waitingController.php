<?php 

class Waiting extends Controller{

    function __construct(){
        parent::__construct();
    }

    function render(){
        // Siempre que pasen esta variable tiene que ir en mayuscula para que el HTML reciba el JS
        $this->view->pathJs = 'Waiting';
        
        $this->view->institutions = $this->model->getInstitutions();
        $this->view->datos = $this->model->getDatos();
        $this->view->title = 'Lista de Espera';
        $this->view->render('waiting/waiting');
    }

}

