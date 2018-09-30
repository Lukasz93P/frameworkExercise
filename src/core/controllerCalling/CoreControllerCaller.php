<?php
declare(strict_types=1);

namespace Core\Controllercalling;

use Core\Controller\CoreController;
use Core\Controllercalling\ControllerCallerInterface;
use Core\Controllercalling\MiddlewareCallerTrait;
use Core\Request\Request;

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
        call_user_func([$controller, $method], new Request($url));
    }

    /**
     * @param CoreController $controller
     * @param string $controllerMethod
     * @param array $middlewares
     * @param array $url
     */
    protected function callWithMiddlewares(CoreController $controller, string $controllerMethod, array $middlewares, array &$url)
    {
        $args = $url;
        $callable = $this->getMiddlewareClassAndMethod($middlewares[0]);
        $request = call_user_func([new $callable[0]($this), $callable[1]], new Request($args));
        array_shift($middlewares);
        foreach ($middlewares as $middleware) {
            if ($this->callNext) {
                $callable = $this->getMiddlewareClassAndMethod($middleware);
                $request = call_user_func([new $callable[0]($this), $callable[1]], new Request($request->url, $request->post));
            }
        }
        if ($this->callNext) {
            call_user_func([$controller, $controllerMethod], new Request($request->url, $request->post));
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