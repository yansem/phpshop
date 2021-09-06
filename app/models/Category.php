<?php

namespace app\models;

use phpshop\App;

class Category extends AppModel
{
    public function getIds($id)
    {
        $cats = App::$app->getProperty('cats');
        $total_cats = null;
        foreach ($cats as $k=>$v)
        {
            if($v['parent_id']==$id){
                $total_cats .= $k . ',';
                $total_cats .= $this->getIDs($k);
            }
        }
        return $total_cats;
    }
}