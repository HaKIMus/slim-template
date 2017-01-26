<?php
declare (strict_types = 1);

namespace Test\Controllers;

use Test\LocalTestCase;

class HomeControllerTest extends LocalTestCase
{
    public function testGetHomepageIsOk()
    {
        $response = $this->runApp('GET', '/');
        $this->assertEquals(200, $response->getStatusCode());
    }
}