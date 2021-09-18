<?php

namespace app\controllers\admin;

use app\models\admin\Modification;
use app\models\admin\Product;
use app\models\AppModel;
use phpshop\App;
use phpshop\libs\Pagination;

class ProductController extends AppController
{
    public function indexAction()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 10;
        $count = \R::count('product');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();

        $products = \R::getAll("SELECT product.*, category.title AS cat FROM product JOIN category ON
    category.id=product.category_id ORDER BY product.title LIMIT $start, $perpage");
        $this->setMeta('Список товаров');
        $this->set(compact('products', 'pagination', 'count'));
    }

    public function editAction()
    {
        if(!empty($_POST)){
            $id = $this->getRequestID(false);
            $product = new Product();
            $data = $_POST;
            $product->load($data);
            $product->attributes['status'] = $product->attributes['status'] ? '1' : '0';
            $product->attributes['hit'] = $product->attributes['hit'] ? '1' : '0';
            $product->getImg();
            if(!$product->validate($data)){
                $product->getErrors();
                redirect();
            }
            if($product->update('product', $id)){
                $product->editFilter($id, $data);
                $product->editRelatedProduct($id, $data);
                $product->saveGallery($id);
                $alias = AppModel::createAlias('product', 'alias', $data['title'], $id);
                $product = \R::load('product', $id);
                $product->alias = $alias;
                \R::store($product);
                $_SESSION['success'] = 'Изменения сохранены';
                redirect();
            }

        }
        $id = $this->getRequestID();
        $product = \R::load('product', $id);
        App::$app->setProperty('parent_id', $product->category_id);
        $filter = \R::getCol('SELECT attr_id FROM attribute_product WHERE product_id=?', [$id]);
        $related_product = \R::getAll("SELECT related_product.related_id, product.title FROM related_product JOIN product ON
related_product.related_id=product.id WHERE related_product.product_id=?", [$id]);
        $gallery = \R::getCol('SELECT img FROM gallery WHERE product_id=?', [$id]);
        $this->setMeta("Редактирование товара {$product->title}");
        $this->set( compact('product','filter', 'related_product', 'gallery'));
    }

    public function deleteAction()
    {
        $id = $this->getRequestID();
        \R::exec("DELETE FROM product WHERE id=?", [$id]);
        \R::exec("DELETE FROM attribute_product WHERE product_id=?", [$id]);
        \R::exec("DELETE FROM modification WHERE product_id=?", [$id]);
        \R::exec("DELETE FROM gallery WHERE product_id=?", [$id]);
        $_SESSION['success'] = 'Продукт удален';
        redirect();

    }

    public function addAction()
    {
        if(!empty($_POST)){
            $product = new Product();
            $data = $_POST;
            $product->load($data);
            $product->attributes['status'] = $product->attributes['status'] ? '1' : '0';
            $product->attributes['hit'] = $product->attributes['hit'] ? '1' : '0';
            $product->getImg();
            if(!$product->validate($data)){
                $product->getErrors();
                $_SESSION['form_data'] = $data;
                redirect();
            }
            if($id = $product->save('product')){
                $product->saveGallery($id);
                $alias = AppModel::createAlias('product', 'alias', $data['title'], $id);
                $p = \R::load('product', $id);
                $p->alias = $alias;
                \R::store($p);
                $product->editFilter($id, $data);
                $product->editRelatedProduct($id, $data);
                $_SESSION['success'] = 'Товар добавлен';
            }
            redirect();
        }
        $this->setMeta('Добавление товара');
    }

    public function relatedProductAction(){
        /*$data = [
            'items' => [
                [
                    'id' => 1,
                    'text' => 'Товар 1',
                ],
                [
                    'id' => 2,
                    'text' => 'Товар 2',
                ],
            ]
        ];*/

        $q = isset($_GET['q']) ? $_GET['q'] : '';
        $data['items'] = [];
        $products = \R::getAssoc('SELECT id, title FROM product WHERE title LIKE ? LIMIT 10', ["%{$q}%"]);
        if($products){
            $i = 0;
            foreach($products as $id => $title){
                $data['items'][$i]['id'] = $id;
                $data['items'][$i]['text'] = $title;
                $i++;
            }
        }
        echo json_encode($data);
        die;
    }

    public function addImageAction()
    {
        if(isset($_GET['upload'])){
            if($_POST['name'] == 'single'){
                $wmax = App::$app->getProperty('img_width');
                $hmax = App::$app->getProperty('img_height');
            }else{
                $wmax = App::$app->getProperty('gallery_width');
                $hmax = App::$app->getProperty('gallery_height');
            }
            $name = $_POST['name'];
            $product = new Product();
            $product->uploadImg($name, $wmax, $hmax);
        }
    }

    public function deleteGalleryAction(){
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $src = isset($_POST['src']) ? $_POST['src'] : null;
        if(!$id || !$src){
            return;
        }
        if(\R::exec("DELETE FROM gallery WHERE product_id = ? AND img = ?", [$id, $src])){
            @unlink(WWW . "/images/$src");
            exit('1');
        }
        return;
    }

    public function modificationAction()
    {
        $modification = \R::getAll("SELECT modification.*, product.title AS product_title FROM modification JOIN product ON modification.product_id=product.id");
        $this->setMeta('Модификации');
        $this->set(compact('modification'));
    }

    public function modificationAddAction()
    {
        if(!empty($_POST)){
            $modification = new Modification();
            $data = $_POST;
            $modification->load($data);
            if(!$modification->validate($data)){
                $modification->getErrors();
                redirect();
            }
            if($modification->save('modification')){
                $_SESSION['success'] = 'Модификация добавлена';
                redirect();
            }

        }
        $product = \R::findAll('product');
        $this->setMeta('Новая модификация');
        $this->set(compact('product'));
    }

    public function modificationEditAction()
    {
        if(!empty($_POST)){
            $id = $this->getRequestID(false);
            $modification = new Modification();
            $data = $_POST;
            $modification->load($data);
            if(!$modification->validate($data)){
                $modification->getErrors();
                redirect();
            }
            if($modification->update('modification', $id)){
                $_SESSION['success'] = 'Изменения сохранены';
                redirect();
            }
        }
        $id = $this->getRequestID();
        $modification = \R::load('modification', $id);
        $product = \R::findAll('product');
        $this->setMeta('Редактирование модификации');
        $this->set(compact('modification', 'product'));
    }

    public function modificationDeleteAction()
    {
        $id = $this->getRequestID();
        $modification = \R::load('modification', $id);
        \R::trash($modification);
        $_SESSION['success'] = 'Модификация удалена';
        redirect();
    }
}