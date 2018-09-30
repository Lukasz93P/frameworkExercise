<?php
declare(strict_types=1);

namespace Application\Middlewares;

use Core\Middleware\AbstractMiddleware;
use Core\Request\Request;

class NextTest extends AbstractMiddleware
{
    public function nextMiddleware(Request $request)
    {
        //$_POST['middleware_test'] = 'SMOKU I BUGS :)';
        //$testArg = 'NEXT MIDDLEWARE WORKING';
        return $request;
    }
}