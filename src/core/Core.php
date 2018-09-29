<?php
declare(strict_types=1);

namespace Core;

use Core\Controller\CoreController;
use Core\ControllerLoaders\ControllerLoaderInterface;

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
     * @var array
     */
    protected $explodedUrl;

    /**
     * Core constructor.
     * @param ControllerLoaderInterface $controllerLoader
     */
    public function __construct(ControllerLoaderInterface $controllerLoader)
    {
        $this->controllerLoader = $controllerLoader;

        if (isset($_GET['url'])) {
            $url = filter_var($_GET['url'], FILTER_SANITIZE_URL);
            $this->explodedUrl = explode('/', $url);
            $this->getController($this->explodedUrl);
            if (!empty($this->explodedUrl)) {
                $this->callController($this->explodedUrl);
            }
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
     * @return mixed
     */
    protected function callController(array &$url)
    {
        $methodName = $url[0];
        if (method_exists($this->controller, $methodName)) {
            array_shift($url);
            return call_user_func_array([$this->controller, $methodName], $url);
        }
        $this->controller->errorResponse(404, 'Requested page not found');
    }
}