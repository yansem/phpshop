<?php


namespace phpshop;


class Db
{
    use TSingleton;

    protected function __construct()
    {
        $db = require_once CONF . '/config_db.php';
        \R::setup($db['dsn'], $db['user'], $db['pass']);
        if(!\R::testConnection()){
            throw new \Exception('Нет соединения с БД', 500);
        }
    }
}