<?php


namespace phpshop;


class Router
{
    protected static $routes = [];
    protected static $route = [];

    public static function add($regexp, $route=[])
    {
        self::$routes[$regexp] = $route;
    }

    public static function getRoutes()
    {
        return self::$routes;
    }

    public static function getRoute()
    {
        return self::$route;
    }

    public static function dispatch($url)
    {
        if (self::matchRoute($url)){
            $controller = 'app\controllers\\' . self::$route['prefix'] . self::$route['controller'] .
                'Controller';
            if(class_exists($controller)){
                $controllerObject = new controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action']) . 'Action';

            }else{throw new \Exception("Контроллер $controller не найден", 404);

            }
        }else{
            throw new \Exception("Страница не найдена", 404);
    }
    }

    public static function matchRoute($url)
    {
        foreach (self::$routes as $pattern=>$route)
        {
            if(preg_match("#{$pattern}#", $url, $matches)){
                foreach ($matches as $k=>$v)
                {
                    if(is_string($k)){
                        $route[$k]=$v;
                    }
                }
                if(empty($route['action'])){
                    $route['action']='index';
                }
                if(!isset($route['prefix'])){
                    $route['prefix']='';
                }else{
                    $route['prefix'] .= '\\';
                }
                $route['controller']=self::upperCamelCase($route['controller']);
                self::$route=$route;
                debug(self::$route);
                return true;
            }
        }
        return false;
    }

    protected static function upperCamelCase($name)
    {
        return $name = str_replace(' ', '',ucwords(str_replace('-', ' ', $name))) ;
    }

    protected static function lowerCamelCase($name)
    {
        return lcfirst(self::upperCamelCase($name));
    }
}