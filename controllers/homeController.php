<?php

class Home extends Controller{
    function __construct(){
        parent::__construct();
    }

    function render(){
        $this->view->datosC = $this->model->getResultC();
        $this->view->datosAnd = $this->model->getResultAnd();
        $this->view->datosAd = $this->model->getResultAd();
        $this->view->AgendamientoXh = $this->model->AgendamientoXHospital();
        $this->view->ConfirmacionXh = $this->model->ConfirmacionXHospital();
        $this->view->SmsXh = $this->model->SmsXHospital();
        $this->view->datosLE = $this->model->getResultListaEspera();
        $this->view->title = 'Home';
        $this->view->render('home/home');
    }
}
