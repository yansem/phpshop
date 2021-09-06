<?php

namespace app\controllers;

use app\models\Breadcrumbs;
use app\models\Category;
use phpshop\App;

class CategoryController extends AppController
{
    public function viewAction()
    {
        $alias = $this->route['alias'];
        $category = \R::findOne('category', "alias=?", [$alias]);
        if(!$category){
            throw new \Exception('Странциа не найдена', 404);
        }
        $breadcrumbs = Breadcrumbs::getBreadcrumbs($category->id);
        $cat_model = new Category();
        $ids = $cat_model->getIds($category->id);
        $ids = !$ids ? $category->id : $ids . $category->id;
        $products = \R::find('product', "category_id IN ($ids)");
        $this->setMeta($category->title, $category->description, $category->keywords);
        $this->set(compact('products', 'breadcrumbs'));
    }
}