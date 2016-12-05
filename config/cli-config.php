<?php
declare (strict_types = 1);

use Doctrine\ORM\Tools\Console\ConsoleRunner;

require __DIR__ . '/../vendor/autoload.php';

$slimConfig = include __DIR__ . '/../app/config/slimConfig.php';
$doctrineSettings = $slimConfig['settings']['doctrine'];

$config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
    $doctrineSettings['meta']['entity_path'],
    $doctrineSettings['meta']['auto_generate_proxies'],
    $doctrineSettings['meta']['proxy_dir'],
    $doctrineSettings['meta']['cache'],
    false
);

$em = \Doctrine\ORM\EntityManager::create($doctrineSettings['connection'], $config);

return ConsoleRunner::createHelperSet($em);