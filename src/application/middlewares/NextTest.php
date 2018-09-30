<?php
declare(strict_types=1);

namespace Application\Middlewares;

use Core\Middleware\AbstractMiddleware;

class NextTest extends AbstractMiddleware
{
    public function nextMiddleware($testArg = null)
    {
        $_POST['middleware_test'] = 'SMOKU I BUGS :)';
        $testArg = 'NEXT MIDDLEWARE WORKING';
        return [$testArg];
    }
}