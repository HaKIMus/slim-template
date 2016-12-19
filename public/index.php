<?php

use Symfony\Component\Yaml\Yaml;

session_start();

require __DIR__ . '/../vendor/autoload.php';

$appConfig = Yaml::parse(file_get_contents(__DIR__ . '/../app/config/appConfig.yml'));
$doctrineConfig = Yaml::parse(file_get_contents(__DIR__ . '/../app/config/doctrineConfig.yml'));

$app = new \Slim\App($appConfig, $doctrineConfig);

$container = $app->getContainer();

require __DIR__ . '/../app/dependencies.php';

require __DIR__ . '/../src/routes.php';

$app->run();