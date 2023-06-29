<?php

class Home extends Controller{
    function __construct(){
        parent::__construct();
    }

    function render(){
        $this->view->pathJs = 'Home';
        $this->view->datosC = $this->model->getResultC();
        $this->view->datosAnd = $this->model->getResultAnd();
        $this->view->datosAd = $this->model->getResultAd();
        $this->view->datosXh = $this->model->getResultXHospital();
        $this->view->title = 'Dashboard';
        $this->view->render('home/home');
    }
}
