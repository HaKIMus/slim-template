<?php
declare (strict_types=1);

namespace Src\Controller;

use Slim\Container;
use Slim\Views\Twig;

class Controller
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function __get(string $property)
    {
        if ($this->container->{$property}) {
            return $this->container->{$property};
        }
    }
}