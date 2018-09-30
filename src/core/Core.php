<?php
declare(strict_types=1);

namespace Core;

use Core\Controller\CoreController;
use Core\ControllerLoaders\ControllerLoaderInterface;
use Core\Methodselection\MethodSelectorInterface;
use Core\Controllercalling\ControllerCallerInterface;

class Core
{
    /**
     * @var ControllerLoaderInterface
     */
    protected $controllerLoader;

    /**
     * @var CoreController
     */
    protected $controller;

    /**
     * @var MethodSelectorInterface
     */
    protected $methodSelector;

    /**
     * @var ControllerCallerInterface
     */
    protected $controllerCaller;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var array
     */
    protected $explodedUrl;

    /**
     * Core constructor.
     * @param ControllerLoaderInterface $controllerLoader
     */
    public function __construct(ControllerLoaderInterface $controllerLoader, MethodSelectorInterface $methodSelector, ControllerCallerInterface $controllerCaller)
    {
        $this->controllerLoader = $controllerLoader;
        $this->methodSelector = $methodSelector;
        $this->controllerCaller = $controllerCaller;
        if (isset($_GET['url'])) {
            $url = filter_var($_GET['url'], FILTER_SANITIZE_URL);
            $this->explodedUrl = explode('/', $url);
            $this->getController($this->explodedUrl);
            if (!empty($this->explodedUrl)) {
                $this->getControllerMethod($this->explodedUrl);
            }
            $this->controllerCaller->callController($this->controller,$this->method, $this->explodedUrl);
        }
    }

    /**
     * @param array $url
     */
    protected function getController(array $url)
    {
        $this->controller = $this->controllerLoader->produceController($this->explodedUrl);
    }

    /**
     * @param array $url
     */
    protected function getControllerMethod(array &$url)
    {
        $this->method = $this->methodSelector->selectMethod($this->controller, $this->explodedUrl);
        if (!$this->method) {
            $this->controller->errorResponse(404, 'Requested page not found');
        }
    }
}