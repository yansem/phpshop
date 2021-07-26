<?php

require_once dirname(__DIR__) . '/config/init.php';
require_once LIBS . '/functions.php';
require_once CONF . '/routes.php';
new \phpshop\App();
debug(\phpshop\Router::getRoutes());
