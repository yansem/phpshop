<?php


namespace app\controllers;


use phpshop\base\Controller;
use phpshop\Cache;

class MainController extends AppController
{

    public function indexAction()
    {
        $posts = \R::findAll('test');
        $this->setMeta('Главная страница', 'Описание...', 'Ключевые слова...');
        $names = ['Peter', 'John'];
        $cache = Cache::instance();
        $data = $cache->get('test');
        if(!$data){
            $cache->set('test', $names);
        }
        debug($data);
        $this->set(compact('posts'));
    }
}