<?php

namespace App\Controllers;

class HomeController extends Controller
{
    public function index($request, $response)
    {
        return $this->view->render($response, 'main/slim_template.twig', [
            'titleWebsite' => 'Slim Template',
        ]);
    }
}