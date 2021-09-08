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
        $sql_part = '';
        foreach ($_SESSION['cart'] as $product_id => $product)
        {
            $product_id = (int)$product_id;
            $sql_part .= "($order_id, $product_id, {$product['qty']}, '{$product['title']}', {$product['price']}),";
        }
        $sql_part = rtrim($sql_part, ',');
        \R::exec("INSERT INTO order_product (order_id, product_id, qty, title, price) VALUES $sql_part");
    }

    public static function mailOrder($order_id, $user_email)
    {

    }
}