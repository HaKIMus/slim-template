<?php
declare (strict_types = 1);

$container = $app->getContainer();

$container['view'] = function($container){
    $view = new \Slim\Views\Twig(__DIR__ . '/../../resources/views', [
        'cache' => false,
    ]);

    $view->addExtension(new Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    return $view;
};

$container['entityManager'] = function ($container) {
    $settings = $container->get('settings');

    $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
        $settings['doctrine']['meta']['entity_path'],
        $settings['doctrine']['meta']['auto_generate_proxies'],
        $settings['doctrine']['meta']['proxy_dir'],
        $settings['doctrine']['meta']['cache'],
        false
    );

    return \Doctrine\ORM\EntityManager::create($settings['doctrine']['connection'], $config);
};

$container['HomeController'] = function($container){
    return new Src\Controllers\HomeController($container);
};