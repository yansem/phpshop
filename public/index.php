<?php

require_once dirname(__DIR__) . '/config/init.php';

new \phpshop\App();
var_dump(\phpshop\App::$app->getProperties());