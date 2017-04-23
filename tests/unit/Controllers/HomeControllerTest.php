<?php

namespace Test\Unit\Controller;

use BaseTestCase;

class HomeControllerTest extends BaseTestCase
{
    protected $app;

    public function _before()
    {
        $this->app = $this->runApp('GET', '/');
    }

    public function testResponseCode()
    {
        $this->assertEquals(200, $this->app->getStatusCode());
    }
}