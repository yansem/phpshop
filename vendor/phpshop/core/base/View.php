<?php


namespace phpshop\base;


class View
{
    public $route;
    public $controller;
    public $view;
    public $layout;
    public $model;
    public $prefix;
    public $data = [];
    public $meta = [];

    public function __construct($route, $layout = '', $view = '', $meta)
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->model = $route['controller'];
        $this->view = $view;
        $this->prefix = $route['prefix'];
        $this->meta = $meta;

        if($layout===false){
            $this->layout=false;
        }else{
            $this->layout=$layout ?: LAYOUT;
        }
    }

    public function render($data)
    {
        $viewFile = APP . "/views/{$this->prefix}{$this->controller}/{$this->view}.php";
        if(is_file($viewFile)){
            require_once $viewFile;
        }else{
            throw new \Exception("Не найден файл {$viewFile}");
        }
    }
}