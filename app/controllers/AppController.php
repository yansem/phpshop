<?php


namespace app\controllers;


use app\models\AppModel;
use app\widgets\currency\Currency;
use phpshop\App;
use phpshop\base\Controller;
use phpshop\base\Model;
use phpshop\Cache;

class AppController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        new AppModel();
        App::$app->setProperty('currensies', Currency::getCurrensies()); // валюты
        App::$app->setProperty('currency', Currency::getCurrency(App::$app->getProperty('currensies')));  // валюта
        App::$app->setProperty('cats', self::cacheCategory());  // категории
    }

    public static function cacheCategory()
    {
        $cache = Cache::instance();
        $cats = $cache->get('cats');
        if(!$cats){
            $cats = \R::getAssoc("SELECT * FROM category");
            $cache->set('cats', $cats);
        }
        return $cats;
    }
}