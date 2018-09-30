<?php
declare(strict_types=1);

namespace Application\Middlewares;

use Core\Middleware\AbstractMiddleware;
use Core\Request\Request;

class TestMiddleware extends AbstractMiddleware
{
    public function testMiddleware(Request $request)
    {
        //$testArg = 'MIDDLEWARE WORKING';
        //$this->callNext = false;
        return $request;
    }
}