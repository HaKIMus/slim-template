<?php
declare (strict_types = 1);

namespace Src\Controllers;

use Slim\Views\Twig;

class Controller
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function __get($property): Twig
    {
        if($this->container->{$property}){
            return $this->container->{$property};
        }
    }
}