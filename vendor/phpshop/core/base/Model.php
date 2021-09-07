<?php


namespace phpshop\base;


use phpshop\Db;
use Valitron\Validator;

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

    public function validate($data)
    {
        $v = new Validator($data);
        $v->rules($this->rules);
        if($v->validate()){
            return true;
        }
        $this->errors = $v->errors();
        return false;
    }

}