<?php


namespace phpshop\base;


use phpshop\Db;

abstract class Model
{
    public $attributes=[];
    public $errors=[];
    public $rules=[];

    public function __construct()
    {
        Db::instance();
    }

}