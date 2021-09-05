<?php

namespace app\controllers;


use app\models\Cart;
use phpshop\App;
use phpshop\base\Controller;

class CurrencyController extends AppController
{
    public function changeAction()
    {
        $currency = !empty($_GET['curr']) ? $_GET['curr'] : null;
        if($currency){
            $curr = \R::findOne('currency', 'code = ?', [$currency]);
            if(array_key_exists($currency, App::$app->getProperty('currensies'))){
                setcookie('currency', $currency, time()+3600*24*7, '/');
            }
        }
        redirect();
    }
}