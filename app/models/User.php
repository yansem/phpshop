<?php

namespace app\models;

class User extends AppModel
{
    public $attributes = [
        'login' => '',
        'password' => '',
        'name' => '',
        'email' => '',
        'address' => '',
    ];

    public $rules = [
        'required' => [
            ['login'],
            ['password'],
            ['name'],
            ['email'],
            ['address']
        ],
        'email' => [
            ['email']
        ],
        'lengthMin' => [
            ['password', 6]
        ]
    ];

    public function getErrors()
    {
        $errors = '<ul>';
        foreach ($this->errors as $error)
        {
            foreach ($error as $item)
            {
                $errors .= "<li>$item</li>";
            }
        }
        $errors .= '</ul>';
        $_SESSION['error'] = $errors;
    }
}