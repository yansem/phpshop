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

    public function load($data)
    {
        foreach ($this->attributes as $name => $value)
        {
            if(isset($data[$name])){  // если отправят "левые" данные, то они не пройдут проверку, т.к. $name уже объявлены
                $this->attributes[$name] = $data[$name];
            }
        }
    }

}