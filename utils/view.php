<?php
class View{
    public $datos;
    public $title;
    public $institutions;
    public $pathJs = null;
    public $message;
    
    function render($name, $message_in = "") { 
        $this->message = $message_in;
        require 'views/'.$name.'.php';
    }
}

