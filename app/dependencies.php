<?php
declare (strict_types = 1);

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Src\Controllers\HomeController;
use Symfony\Component\Yaml\Yaml;

$container = $app->getContainer();

$container['view'] = function($container): Twig{
    $view = new Twig(__DIR__ . '/../resources/views', [
        'cache' => false,
    ]);

    $view->addExtension(new TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    return $view;
};

$container['entityManager'] = function (): EntityManager {
    $doctrineConfig = Yaml::parse(file_get_contents(__DIR__ . '/../app/config/doctrineConfig.yml'));

    $paths = $doctrineConfig['doctrine']['meta']['entityPath'];
    $isDevMode = $doctrineConfig['doctrine']['meta']['devMode'];
    $dbParams = $doctrineConfig['doctrine']['connection'];

    $config = Setup::createYAMLMetadataConfiguration($paths, $isDevMode);

    $namespaces = [
        __DIR__ . '/../src/Entity' => 'Entity'
    ];

    $driver = new \Doctrine\ORM\Mapping\Driver\SimplifiedYamlDriver($namespaces);

    $config->setMetadataDriverImpl($driver);

    return EntityManager::create($dbParams, $config);
};

$container['HomeController'] = function($container): HomeController {
    return new HomeController($container);
};