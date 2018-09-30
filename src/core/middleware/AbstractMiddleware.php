<?php
declare(strict_types=1);

namespace Core\Middleware;

use Core\Controllercalling\ControllerCallerInterface;

abstract class AbstractMiddleware
{
    /**
     * @var ControllerCallerInterface
     */
    private $controllerCaller;

    /**
     * AbstractMiddleware constructor.
     * @param ControllerCallerInterface $controllerCaller
     */
    public function __construct(ControllerCallerInterface $controllerCaller)
    {
        $this->controllerCaller = $controllerCaller;
    }

    /**
     * @param string $name
     * @param $value
     */
    public function __set(string $name, $value)
    {
        $methodName = "set$name";
        if (method_exists($this->controllerCaller, $methodName)) {
            $this->controllerCaller->$methodName($value);
        }
    }
}