<?php

namespace app\controllers\admin;

use app\models\AppModel;
use app\models\Category;
use phpshop\Cache;

class CategoryController extends AppController
{
    public function indexAction()
    {
        $this->setMeta('Список категорий');
    }

    public function deleteAction()
    {
        $category_id = $this->getRequestID();
        $errors = '';
        $children = \R::count('category', 'parent_id=?', [$category_id]);
        if($children){
            $errors .= "<li>Удаление невозможно, в категории есть вложенные категории</li>";
        }
        $products = \R::count('product', 'category_id=?', [$category_id]);
        if($products){
            $errors .= "<li>Удаление невозможно, в категории есть товары</li>";
        }
        if($errors){
            $_SESSION['error'] = "<ul>$errors</ul>";
            redirect();
        }
        $category = \R::load('category', $category_id);
        \R::trash($category);
        $_SESSION['success'] = 'Категория удалена';
        redirect();

    }

    public function addAction()
    {
        if(!empty($_POST)){
            $category = new Category();
            $data = $_POST;
            $category->load($data);
            if(!$category->validate($data)){
                $category->getErrors();
                redirect();
            }
            if($id=$category->save('category')){
                $alias = AppModel::createAlias('category', 'alias', $data['title'], $id);
                $cat = \R::load('category', $id);
                $cat->alias = $alias;
                \R::store($cat);
                $_SESSION['success'] = 'Категория добавлена';
            }
            redirect();
        }
        $this->setMeta('Новая категори');
    }
}