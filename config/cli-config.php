<?php
declare (strict_types=1);

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\Yaml\Yaml;

require __DIR__ . '/../vendor/autoload.php';

$doctrineSettings = Yaml::parse(file_get_contents(__DIR__ . '/../app/config/doctrine.yml'))['doctrine'];

$config = Setup::createAnnotationMetadataConfiguration(
    $doctrineSettings['meta']['entity_path'],
    $doctrineSettings['meta']['auto_generate_proxies'],
    $doctrineSettings['meta']['proxy_dir'],
    $doctrineSettings['meta']['cache'],
    false
);

$em = EntityManager::create($doctrineSettings['connection'], $config);

return ConsoleRunner::createHelperSet($em);