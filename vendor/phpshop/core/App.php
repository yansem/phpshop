<?php


namespace phpshop;


class App
{
    public static $app;

    public function __construct(){
        $query = trim($_SERVER['QUERY_STRING'], '/');
        session_start();
        self::$app = Registry::$instance;
    }
}