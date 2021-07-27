<?php


namespace app\controllers;


use phpshop\base\Controller;

class MainController extends Controller
{

    public function indexAction()
    {
        debug($this->route);
        debug($this->controller);
        echo __METHOD__;
    }
}