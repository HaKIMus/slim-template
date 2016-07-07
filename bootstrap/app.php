<?php
/**
 * @links
 * Slim Doc        * http://www.slimframework.com/docs/
 * Template Source * https://youtu.be/RhcQXFeor9g?list=PLfdtiltiRHWGc_yY90XRdq6mRww042aEC
 */
// https://www.youtube.com/watch?v=mES64glnp7k&index=8&list=PLfdtiltiRHWGc_yY90XRdq6mRww042aEC
// Odcinek nr. 8

session_start();

/*Composer*/
require __DIR__ . '/../vendor/autoload.php';

/*Config*/
$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'slim',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]
    ]
]);


$container = $app->getContainer();

/*Database*/
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function($container) use ($capsule){
    return $capsule;
};

/*Twig*/
$container['view'] = function($container){
    $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
        'cache' => false,
    ]);

    $view->addExtension(new Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    return $view;
};

$container['HomeController'] = function($container){
    return new \App\Controllers\HomeController($container);
};

$container['ExampleController'] = function($container){
    return new \App\Controllers\ExampleController($container);
};

require __DIR__ . '/../app/routes.php';