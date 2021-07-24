<?php

define("DEBUG", 1);
define("ROOT", dirname(__DIR__));
define("WWW", dirname(__DIR__ . '/public'));
define("APP", dirname(__DIR__ . '/app'));
define("CORE", dirname(__DIR__ . '/vendor/phpshop/core'));
define("LIBS", dirname(__DIR__ . '/vendor/phpshop/core/libs'));
define("CACHE", dirname(__DIR__ . '/tmp/cache'));
define("CONF", dirname(__DIR__ . '/config'));
define("LAYOUT", 'default');

$app_path = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}";
$app_path = preg_replace("#[^/]+$#", '', $app_path);
$app_path = str_replace('/public/', '', $app_path);

define("PATH", $app_path);
define("ADMIN", PATH . '/admin');
require_once ROOT . '/vendor/autoload.php';
