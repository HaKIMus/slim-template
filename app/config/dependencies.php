<?php
declare (strict_types = 1);

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Src\Controllers\HomeController;

$container = $app->getContainer();

$container['view'] = function($container){
    $view = new Twig(__DIR__ . '/../../resources/views', [
        'cache' => false,
    ]);

    $view->addExtension(new TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    return $view;
};

$container['entityManager'] = function ($container): EntityManager {
    $settings = $container->get('settings');

    $config = Setup::createAnnotationMetadataConfiguration(
        $settings['doctrine']['meta']['entity_path'],
        $settings['doctrine']['meta']['auto_generate_proxies'],
        $settings['doctrine']['meta']['proxy_dir'],
        $settings['doctrine']['meta']['cache'],
        false
    );

    return EntityManager::create($settings['doctrine']['connection'], $config);
};

$container['HomeController'] = function($container): HomeController {
    return new HomeController($container);
};