<?php
declare(strict_types=1);

namespace Core\Controllercalling;

use Core\Controller\CoreController;
use Core\Controllercalling\ControllerCallerInterface;
use Core\Controllercalling\MiddlewareCallerTrait;

class CoreControllerCaller implements ControllerCallerInterface
{
    use MiddlewareCallerTrait;

    /**
     * @var bool
     */
    protected $callNext = true;

    /**
     * @param CoreController $controller
     * @param string $method
     * @param array|null $url
     * @return mixed|void
     */
    public function callController(CoreController $controller, string $method, array &$url = null)
    {
        $controllerClass = get_class($controller);
        if (array_key_exists($controllerClass, $this->middlewares)) {
            if ($this->middlewares[$controllerClass] === 'all') {
                return $this->callWithMiddlewares($controller, $method, $this->middlewares[$controllerClass]['all'], $url);
            } elseif (array_key_exists($method, $this->middlewares[$controllerClass])) {
                return $this->callWithMiddlewares($controller, $method, $this->middlewares[$controllerClass][$method], $url);
            }
        }
        call_user_func_array([$controller, $method], $url);
    }

    /**
     * @param CoreController $controller
     * @param string $controllerMethod
     */
    protected function callWithMiddlewares(CoreController $controller, string $controllerMethod, array $middlewares, array &$url = null)
    {
        $args = $url;
        foreach ($middlewares as $middleware) {
            if ($this->callNext) {
                $callable = $this->getMiddlewareClassAndMethod($middleware);
                $args = call_user_func_array([new $callable[0]($this), $callable[1]], $args);
            }
        }
        if ($this->callNext) {
            call_user_func_array([$controller, $controllerMethod], $args);
        }
    }

    /**
     * @param string $classAndMethod
     * @return array
     */
    protected function getMiddlewareClassAndMethod(string $classAndMethod): array
    {
        return explode('|', $classAndMethod);
    }

    /**
     * @param bool $callNext
     * @return mixed|void
     */
    public function setCallNext(bool $callNext)
    {
        $this->callNext = $callNext;
    }
}