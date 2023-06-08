<?php
class View{
    public $datos;
    public $title;
    public $institutions;
    
    function render($name) { 
        require 'views/'.$name.'.php';
    }
}

