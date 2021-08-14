<?php

namespace app\models;

class Product extends AppModel
{
    public function setRecentlyViewed($id)
    {
        $recently_viewed = $this->getAllRecentlyViewed();
        if(!$recently_viewed){
            setcookie('recentlyViewed', $id, time()+3600*24, '/');
        }else{
            $recently_viewed = explode('.', $recently_viewed);
            if(!in_array($id, $recently_viewed)){
                $recently_viewed[]=$id;
                $recently_viewed=implode('.',$recently_viewed);
                setcookie('recentlyViewed', $recently_viewed, time()+3600*24, '/');
            }
        }

    }

    public function getRecentlyViewed()
    {

    }

    public function getAllRecentlyViewed()
    {
        if(!empty($_COOKIE['recentlyViewed'])){
            return $_COOKIE['recentlyViewed'];
        }
        return false;

    }
}