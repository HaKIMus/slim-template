<?php
declare (strict_types=1);

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Src\Controllers\HomeController;
use Symfony\Component\Yaml\Yaml;

$container = $app->getContainer();

$container['titleWebsite'] = $appConfig['extras']['titleWebsite'];

$container['view'] = function($container){
    $view = new Twig(__DIR__ . '/resources/views', [
        'cache' => false,
    ]);

    $view->addExtension(new TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    return $view;
};

$container['entityManager'] = function ($container): EntityManager {
    $doctrineSettings = Yaml::parse(file_get_contents(__DIR__ . '/../app/config/doctrine.yml'))['doctrine'];

    $config = Setup::createAnnotationMetadataConfiguration(
        $doctrineSettings['meta']['entity_path'],
        $doctrineSettings['meta']['auto_generate_proxies'],
        $doctrineSettings['meta']['proxy_dir'],
        $doctrineSettings['meta']['cache'],
        false
    );

    return EntityManager::create($doctrineSettings['connection'], $config);
};

$container['HomeController'] = function($container): HomeController {
    return new HomeController($container);
};