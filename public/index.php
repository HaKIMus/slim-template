<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';
$appConfig = require __DIR__ . '/../app/config/appConfig.php';

$app = new \Slim\App($appConfig);

$container = $app->getContainer();

require __DIR__ . '/../app/config/dependencies.php';

require __DIR__ . '/../src/routes.php';

$app->run();