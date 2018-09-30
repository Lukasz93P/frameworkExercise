<?php
declare(strict_types=1);

namespace Application\Middlewares;

use Core\Middleware\AbstractMiddleware;

class TestMiddleware extends AbstractMiddleware
{
    public function testMiddleware($testArg = null)
    {
        $testArg = 'MIDDLEWARE WORKING';
        //$this->callNext = false;
        return [$testArg];
    }
}