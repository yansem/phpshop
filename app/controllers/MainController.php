<?php


namespace app\controllers;


use phpshop\base\Controller;

class MainController extends AppController
{

    public function indexAction()
    {
//        echo __METHOD__;
        $this->setMeta('Главная страница', 'Описание...', 'Ключевые слова...');
    }
}