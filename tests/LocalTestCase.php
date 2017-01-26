<?php

namespace Test;
use Psr\Http\Message\ResponseInterface;
use Slim\App;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Environment;
use Symfony\Component\Yaml\Yaml;

class LocalTestCase extends \PHPUnit_Framework_TestCase
{
    protected $withMiddleware = true;
    protected $container;

    public function runApp(string $requestMethod, string $requestUri, $requestData = null): ResponseInterface
    {
        $environment = Environment::mock(
            [
                'REQUEST_METHOD' => $requestMethod,
                'REQUEST_URI' => $requestUri
            ]
        );

        $request = Request::createFromEnvironment($environment);

        if (isset($requestData)) {
            $request = $request->withParsedBody($requestData);
        }

        $response = new Response();
        $settings = Yaml::parse(file_get_contents(__DIR__ . '/../app/config/app.yml'));
        $app = new App($settings);
        $this->container = new Container();

        require __DIR__ . '/../app/dependencies.php';

        require __DIR__ . '/../app/middleware.php';

        require __DIR__ . '/../src/routes.php';

        $response = $app->process($request, $response);

        return $response;
    }
}
