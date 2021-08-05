<?php


namespace app\controllers;


use app\models\AppModel;
use app\widgets\currency\Currency;
use phpshop\App;
use phpshop\base\Controller;
use phpshop\base\Model;

class AppController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        new AppModel();
        setcookie('currency', 'EUR', time()+3600*24*7, '/');
        App::$app->setProperty('currensies', Currency::getCurrensies());
        App::$app->setProperty('currency', Currency::getCurrency(App::$app->getProperty('currensies')));
        debug(App::$app->getProperties());
    }
}