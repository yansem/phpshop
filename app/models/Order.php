<?php

namespace app\models;

use phpshop\base\Model;

class Order extends AppModel
{
    public $attributes = [
        'user_id' => '',
        'note' => '',
        'currency' => ''
    ];

    public function saveOrder($data)
    {
        return $this->save('order');
    }

    public static function saveOrderProduct($order_id)
    {

    }

    public static function mailOrder($order_id, $user_email)
    {

    }
}