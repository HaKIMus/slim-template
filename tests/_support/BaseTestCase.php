<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Environment;
use Symfony\Component\Yaml\Yaml;

/**
 * This is an example class that shows how you could set up a method that
 * runs the application. Note that it doesn't cover all use-cases and is
 * tuned to the specifics of this skeleton app, so if your needs are
 * different, you'll need to change it.
 *
 * @link https://github.com/slimphp/Slim-Skeleton/blob/master/tests/Functional/BaseTestCase.php
 */
class BaseTestCase extends \Codeception\Test\Unit
{
    /**
     * Use middleware when running application?
     *
     * @var bool
     */
    protected $withMiddleware = true;

    /**
     * Process the application given a request method and URI
     *
     * @param string $requestMethod the request method (e.g. GET, POST, etc.)
     * @param string $requestUri the request URI
     * @param array|object|null $requestData the request data
     * @return \Psr\Http\Message\ResponseInterface
     */

    public function runApp($requestMethod, $requestUri, $requestData = null): \Psr\Http\Message\ResponseInterface
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

        $settings = Yaml::parse(file_get_contents(__DIR__ . '/../../app/config/app.yml'));

        $app = new App($settings);

        require __DIR__ . '/../../src/dependencies.php';

        if ($this->withMiddleware) {
            require __DIR__ . '/../../src/middleware.php';
        }

        require __DIR__ . '/../../src/routes.php';

        $response = $app->process($request, $response);

        return $response;
    }
}