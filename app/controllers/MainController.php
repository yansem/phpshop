<?php


namespace app\controllers;


use phpshop\base\Controller;

class MainController extends AppController
{

    public function indexAction()
    {
        $posts = \R::findAll('test');
        $this->setMeta('Главная страница', 'Описание...', 'Ключевые слова...');
        $this->set(compact('posts'));
    }
}