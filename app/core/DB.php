<?php
class DB extends PDO
{
    private static $instance=null;

    private function __construct($base)
    {
        $dsn='mysql:host=' . $base['server'] . ';dbname=' . $base['base'] . ';charset=utf8mb4';
        parent::__construct($dsn,$base['user'],$base['password']);
        
        $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
    }

    public static function getInstance()
    {
        if(self::$instance==null){
            self::$instance=new self(App::config('base'));        
        }
        return self::$instance;
    }

}