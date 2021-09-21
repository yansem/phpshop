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
            if($user->validate($data) && $user->checkUnique()){
                $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
                if($user->save('user')){
                    $_SESSION['success'] = 'Пользователь зарегистрирован';
                }else{
                    $_SESSION['error'] = 'Ошибка!';
                }
            }else{
                $user->getErrors();
                $_SESSION['form_data'] = $data;
            }
            redirect();
        }
        $this->setMeta('Регистрация');
    }

    public function loginAction()
    {
        if(!empty($_POST)){
            $user = new User();
            if($user->login()){
                $_SESSION['success'] = 'Вы успешно авторизованы';
                redirect('/user/account');
            }else{
                $_SESSION['error'] = 'Логин/пароль введены неверно';
            }
            redirect();
        }
        $this->setMeta('Вход');
    }

    public function logoutAction()
    {
        if(isset($_SESSION['user'])) unset($_SESSION['user']);
        redirect();
    }

    public function accountAction()
    {
        if(!User::checkAuth()) redirect();
        $this->setMeta('Личный кабинет');
    }

    public function editAction()
    {
        if(!User::checkAuth()) redirect('/user/login');
        if(!empty($_POST)){
            $user = new \app\models\admin\User();
            $data = $_POST;
            $data['id'] = $_SESSION['user']['id'];
            $data['role'] = $_SESSION['user']['role'];
            $user->load($data);
            if(!$user->attributes['password']){
                unset($user->attributes['password']);
            }else{
                $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
            }
            if (!$user->validate($data) || !$user->checkUnique()) {
                $user->getErrors();
                redirect();
            }
            if ($user->update('user', $_SESSION['user']['id'])) {
                foreach ($user->attributes as $k => $v){
                    if($k != 'password') $_SESSION['user'][$k] = $v;
                }
                $_SESSION['success'] = 'Изменения сохранены';
            }
            redirect();
        }
        $this->setMeta('Изменение личных данных');
    }
}