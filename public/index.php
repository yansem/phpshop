<?php

require_once dirname(__DIR__) . '/config/init.php';
require_once LIBS . '/functions.php';
new \phpshop\App();
throw new Exception('исключение', 404);