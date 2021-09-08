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
        $order_id = $this->save('order');
        self::saveOrderProduct($order_id);
        return $order_id;
    }

    public static function saveOrderProduct($order_id)
    {

    }

    public static function mailOrder($order_id, $user_email)
    {

    }
}