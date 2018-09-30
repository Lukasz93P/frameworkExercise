<?php
declare(strict_types=1);

namespace Core\Controllercalling;

trait MiddlewareCallerTrait
{
    /**
     * @var array
     */
    protected $middlewares = ['Application\Controllers\Contentlist\Listing' => ['index' => ['Application\Middlewares\TestMiddleware|testMiddleware', 'Application\Middlewares\NextTest|nextMiddleware']]];
}