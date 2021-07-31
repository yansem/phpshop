<?php


namespace app\controllers;


use phpshop\base\Controller;

class MainController extends AppController
{

    public function indexAction()
    {
        $posts = \R::findAll('test');
        debug($posts);
        $this->setMeta('Главная страница', 'Описание...', 'Ключевые слова...');
    }
}