<?php

namespace app\controllers;

use app\models\User;

class UserController extends AppController
{
    public function signupAction()
    {
        if(!empty($_POST)){
            $user = new User();
            $data = $_POST;
            $user->load($data);
            if($user->validate($data)){
                $_SESSION['success'] = 'OK';
                redirect();
            }else{
                $user->getErrors();
                redirect();
            }
        }
        $this->setMeta('Регистрация');
    }

    public function loginAction()
    {

    }

    public function logoutAction()
    {

    }
}