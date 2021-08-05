<?php

namespace app\widgets\currency;

class Currency
{
    protected $tpl;
    protected $currensies;
    protected $currency;

    public function __construct()
    {
        $this->tpl = __DIR__ . '/currency_tpl/currency.php';
        $this->run();
    }

    protected function run()
    {
        $this->getHtml();
    }

    public static function getCurrensies()
    {
        return \R::getAssoc("SELECT code, title, symbol_left, symbol_right, value, base
FROM currency ORDER by base DESC");
    }

    public static function getCurrency($currensies)
    {
        if(isset($_COOKIE['currency']) && array_key_exists($_COOKIE['currency'], $currensies)){
            $key = $_COOKIE['currency'];
        }else{
            $key = key($currensies);
        }
        $currency = $currensies[$key];
        $currency['code'] = $key;
        return $currency;
    }

    protected function getHtml()
    {

    }


}