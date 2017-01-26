<?php

use Symfony\Component\Yaml\Yaml;

session_start();

require __DIR__ . '/../vendor/autoload.php';
$appConfig = Yaml::parse(file_get_contents('../app/config/app.yml'));

$app = new \Slim\App($appConfig);

$container = $app->getContainer();

require __DIR__ . '/../app/dependencies.php';
require __DIR__ . '/../app/middleware.php';
require __DIR__ . '/../src/routes.php';

$app->run();