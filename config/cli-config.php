<?php
declare (strict_types = 1);

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;

require __DIR__ . '/../vendor/autoload.php';

$slimConfig = include __DIR__ . '/../app/config/appConfig.php';
$doctrineSettings = $slimConfig['settings']['doctrine'];

$config = Setup::createAnnotationMetadataConfiguration(
    $doctrineSettings['meta']['entity_path'],
    $doctrineSettings['meta']['auto_generate_proxies'],
    $doctrineSettings['meta']['proxy_dir'],
    $doctrineSettings['meta']['cache'],
    false
);

$em = EntityManager::create($doctrineSettings['connection'], $config);

return ConsoleRunner::createHelperSet($em);