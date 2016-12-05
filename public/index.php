<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';
$slimConfig = require __DIR__ . '/../app/config/slimConfig.php';

$app = new \Slim\App($slimConfig);

$container = $app->getContainer();

require __DIR__ . '/../app/config/depdencies.php';

$container['HomeController'] = function($container){
    return new \Src\Controllers\HomeController($container);
};

require __DIR__ . '/../src/routes.php';

$app->run();