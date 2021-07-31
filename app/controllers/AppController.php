<?php


namespace app\controllers;


use app\models\AppModel;
use phpshop\base\Controller;
use phpshop\base\Model;

class AppController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        new AppModel();
    }
}