<?php

namespace app\controllers\admin;

class CurrencyController extends AppController
{
    public function indexAction()
    {
        $currencies = \R::findAll('currency');
        $this->setMeta('Список валют');
        $this->set(compact('currencies'));
    }
}