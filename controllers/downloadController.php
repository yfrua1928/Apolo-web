<?php

class Download extends Controller{
    function __construct(){
        parent::__construct();
    }

    function render(){
        $this->view->pathJs = 'registers.js';
        $this->view->datos = $this->model->getFiles();
        $this->view->title = 'Descarga Documentos';
        $this->view->render('download/download');
    }
}
