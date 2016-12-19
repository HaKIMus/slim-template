<?php
declare (strict_types = 1);

namespace Src\Controllers;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class HomeController extends Controller
{
    public function index(Request $request, Response $response): ResponseInterface
    {
        return $this->view->render($response, 'main/homepage.twig', [
            'titleWebsite' => 'Slim Template',
        ]);
    }
}