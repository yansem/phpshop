<?php


namespace app\controllers;


use phpshop\base\Controller;
use phpshop\Cache;

class MainController extends AppController
{

    public function indexAction()
    {
        $brands = \R::find('brand', 'LIMIT 3');
        $this->set(compact('brands'));
        $this->setMeta('Главная страница', 'Описание...', 'Ключевые слова...');

    }
}