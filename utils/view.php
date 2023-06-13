<?php
class View{
    public $datos;
    public $title;
    public $institutions;
    public $pathJs = null;
    
    function render($name) { 
        require 'views/'.$name.'.php';
    }
}

