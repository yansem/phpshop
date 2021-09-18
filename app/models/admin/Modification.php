<?php

namespace app\models\admin;

use app\models\AppModel;

class Modification extends AppModel
{
    public $attributes = [
        'product_id' => '',
        'title' => '',
        'price' => ''
    ];

    public $rules = [
        'required' => [
            ['product_id'],
            ['title'],
            ['price']
        ],
        'integer' => [
            ['product_id']
        ],
        'numeric' => [
            ['price']
        ]
    ];
}