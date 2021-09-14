<?php

namespace app\controllers\admin;

use app\models\User;
use phpshop\libs\Pagination;

class UserController extends AppController
{
    public function indexAction()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 3;
        $count = \R::count('user');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();

        $users = \R::findAll('user',"LIMIT $start, $perpage");
        $this->set(compact('users', 'pagination', 'count'));
        $this->setMeta('Список пользователей');
    }



    public function loginAdminAction()
    {
        $this->layout = 'login';
        if(!empty($_POST)){
            $user = new User();
            if($user->login(true)){
                $_SESSION['error'] = 'Логин/пароль введены неверно';
            }
            if(User::isAdmin()){
                redirect(ADMIN);
            }else{
                redirect();
            }
        }
    }
}