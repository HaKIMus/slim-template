<?php
declare (strict_types = 1);

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\Yaml\Yaml;

require __DIR__ . '/../vendor/autoload.php';

$doctrineConfig = Yaml::parse(file_get_contents(__DIR__ . '/../app/config/doctrineConfig.yml'));

$paths = $doctrineConfig['doctrine']['meta']['entityPath'];
$isDevMode = $doctrineConfig['doctrine']['meta']['devMode'];
$dbParams = $doctrineConfig['doctrine']['connection'];
$config = Setup::createYAMLMetadataConfiguration($paths, $isDevMode);

$namespaces = [
    __DIR__ . '/../src/Entity' => 'Entity'
];

$driver = new \Doctrine\ORM\Mapping\Driver\SimplifiedYamlDriver($namespaces);
$driver->setGlobalBasename('global');

$config->setMetadataDriverImpl($driver);

$entityManger = EntityManager::create($dbParams, $config
);

return ConsoleRunner::createHelperSet($entityManger);