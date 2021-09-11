<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Order;
use app\models\User;

class CartController extends AppController
{
    public function addAction()
    {
        $id = !empty($_GET['id']) ? (int)$_GET['id'] : null;
        $qty = !empty($_GET['qty']) ? (int)$_GET['qty'] : null;
        $mod_id = !empty($_GET['mod']) ? (int)$_GET['mod'] : null;
        $mod = null;
        if ($id) {
            $product = \R::findOne('product', 'id=?', [$id]);
            if (!$product) {
                return false;
            }
        }
        if ($mod_id) {
            $mod = \R::findOne('modification', 'id=? AND product_id=?', [$mod_id, $id]);
        }
        $cart = new Cart();
        $cart->addToCart($product, $qty, $mod);
        if(!empty($_GET['source'])){
            if ($this->isAjax()) {
                $this->loadView('view');
            }
        }else{
            if ($this->isAjax()) {
                $this->loadView('cart_modal');
            }
        }
        redirect();
    }

    public function addNewAction()
    {
        $id = !empty($_GET['id']) ? (int)$_GET['id'] : null;
        $oldQty = !empty($_GET['qty']) ? (int)$_GET['oldQty'] : null;
        $qty = !empty($_GET['qty']) ? (int)$_GET['qty'] : null;
        $mod_id = !empty($_GET['mod']) ? (int)$_GET['mod'] : null;
        $mod = null;
        if ($id) {
            $product = \R::findOne('product', 'id=?', [$id]);
            if (!$product) {
                return false;
            }
        }
        if ($mod_id) {
            $mod = \R::findOne('modification', 'id=? AND product_id=?', [$mod_id, $id]);
        }
        $cart = new Cart();
        $cart->addNewToCart($product, $oldQty, $qty, $mod);
        if(!empty($_GET['source'])){
            if ($this->isAjax()) {
                $this->loadView('view');
            }
        }else{
            if ($this->isAjax()) {
                $this->loadView('cart_modal');
            }
        }
        redirect();
    }

    public function showAction()
    {
        $this->loadView('cart_modal');
    }

    public function deleteAction()
    {
        $id = !empty($_GET['id']) ? $_GET['id'] : null;
        if (isset($_SESSION['cart'][$id])) {
            $cart = new Cart();
            $cart->deleteItem($id);
        }
        if(!empty($_GET['source'])){
            if ($this->isAjax()) {
                $this->loadView('view');
            }
        }else{
            if ($this->isAjax()) {
                $this->loadView('cart_modal');
            }
        }

        redirect();
    }

    public function clearAction()
    {
        unset($_SESSION['cart']);
        unset($_SESSION['cart.qty']);
        unset($_SESSION['cart.sum']);
        unset($_SESSION['cart.currency']);
        $this->loadView('cart_modal');
    }

    public function viewAction()
    {
        $this->setMeta('Оформление заказа');
    }

    public function checkoutAction()
    {
        if(!empty($_POST)){
            if(!User::checkAuth()){
                $user = new User();
                $data = $_POST;
                $user->load($data);
                if($user->validate($data) && $user->checkUnique()){
                    $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
                    if(!$user_id = $user->save('user')){
                        $_SESSION['error'] = 'Ошибка!';
                        redirect();
                    }
                }else{
                    $user->getErrors();
                    $_SESSION['form_data'] = $data;
                    redirect();
                }
            }
            $data['user_id'] = isset($user_id) ? $user_id : $_SESSION['user']['id'];
            $data['note'] = !empty($_POST['note']) ? $_POST['note'] : '';
            $data['currency'] = $_SESSION['cart.currency']['code'];
            $user_email = isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : $_POST['email'];

            $order = new Order();
            $order->load($data);
            $order_id = $order->saveOrder($data);
            Order::mailOrder($order_id, $user_email);
        }
        redirect();
    }
}