<?php

namespace app\controllers\admin;

use phpshop\App;
use phpshop\libs\Pagination;

class SearchController extends AppController
{
    public function indexAction()
    {

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 10;

        $query = !empty(trim($_GET['s'])) ? trim($_GET['s']) : null;
        if($query){
            $products = \R::find('product', "title LIKE ? AND status = '1'", ["%{$query}%"]);
        }

        $count = count($products);
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();
        $products = \R::getAll("SELECT product.*, category.title AS cat FROM product JOIN category ON
    category.id=product.category_id WHERE product.title LIKE ? AND status = '1' ORDER BY product.title LIMIT $start, $perpage", ["%{$query}%"]);
//        $products = \R::find('product', "title LIKE ? AND status = '1' LIMIT $start, $perpage", ["%{$query}%"]);


        $this->setMeta('Поиск по: ' . h($query));
        $this->set(compact('products', 'query', 'pagination', 'count'));
    }
}