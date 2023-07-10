<?php
class connection{
    private static $instance = null;

    private function __construct(){ }

    private function __clone(){}

    public function __wakeup(){
        throw new \Exception("Cannot unserialize singleton");
    }

    public static function getInstance(){
        if(self::$instance === null){
            $connection = new mysqli("154.53.50.137", "ApoloWeb", "Tms4p0loW3b2023*?", "appointment_booking");
            self::$instance = $connection;
        }

        return self::$instance;
    }
} 