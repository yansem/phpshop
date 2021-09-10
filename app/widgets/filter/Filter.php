<?php

namespace app\widgets\filter;

use phpshop\Cache;

class Filter
{
    public $groups;
    public $attrs;
    public $tpl;

    public function __construct()
    {
        $this->tpl = __DIR__ . '/filter_tpl.php';
        $this->run();
    }

    protected function run()
    {
        $cache = Cache::instance();
        $this->groups = $cache->get('filter_group');
        if(!$this->groups){
            $this->groups = $this->getGroup();
            $cache->set('filter_group', $this->groups, 30);
        }
        $this->attrs = $cache->get('filter_attrs');
        if(!$this->attrs){
            $this->attrs = $this->getAttrs();
            $cache->set('filter_attrs', $this->attrs, 30);
        }
//        debug($this->groups);
//        debug($this->attrs);
        echo $this->getHtml();

    }

    protected function getGroup()
    {
        return \R::getAssoc('SELECT id, title FROM attribute_group');
    }

    protected function getAttrs()
    {
        $data = \R::getAssoc('SELECT * FROM attribute_value');
        $attrs = [];
        foreach ($data as $k => $v)
        {
            $attrs[$v['attr_group_id']][$k] = $v['value'];

        }
        return $attrs;
    }

    protected function getHtml()
    {
        ob_start();
        require_once $this->tpl;
        return ob_get_clean();
    }

    public static function getFilter()
    {
        $filter = null;
        if(!empty($_GET['filter'])){
            $filter = preg_replace("#[^\d,]+#", '', $_GET['filter']);
            $filter = trim($filter, ',');
        }
        return $filter;
    }
}