<?php


namespace phpshop;


class App
{
    public function __construct(){
        $query = trim($_SERVER['QUERY_STRING'], '/');
        var_dump($query);
    }
}