<?php


namespace app\controllers;


use phpshop\base\Controller;
use phpshop\Cache;

class MainController extends AppController
{

    public function indexAction()
    {
        $this->setMeta('Главная страница', 'Описание...', 'Ключевые слова...');

    }
}