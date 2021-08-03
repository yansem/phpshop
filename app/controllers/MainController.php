<?php


namespace app\controllers;


use phpshop\base\Controller;
use phpshop\Cache;

class MainController extends AppController
{

    public function indexAction()
    {
        $brands = \R::find('brand', 'LIMIT 3');
        $hits = \R::find('product', "hit='1' AND status='1' LIMIT 8");
        $this->set(compact('brands', 'hits'));
        $this->setMeta('Главная страница', 'Описание...', 'Ключевые слова...');

    }
}