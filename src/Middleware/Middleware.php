<?php
declare (strict_types = 1);

namespace App\Middleware;

class Middleware
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }
}