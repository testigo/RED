<?php

date_default_timezone_set('Europe/Kiev');

if ($_SERVER['APPLICATION_ENV'] == 'development') {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

chdir(dirname(__DIR__));

define("APP_DIR", dirname(__DIR__));

define("PUBLIC_DIR", 'public');

if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

require 'init_autoloader.php';

Zend\Mvc\Application::init(require 'config/application.config.php')->run();
