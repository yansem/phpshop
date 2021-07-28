<?php


namespace phpshop;


class Db
{
    use TSingleton;

    protected function __construct()
    {
        $db = require_once CONF . 'config_db.php';
    }
}