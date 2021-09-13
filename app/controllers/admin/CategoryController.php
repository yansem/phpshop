<?php

namespace app\controllers\admin;

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
}