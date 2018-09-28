<?php
declare(strict_types=1);

namespace Core;

use Core\Controller\CoreController;
use Core\ControllerLoaders\ControllerLoaderInterface;
use Core\Helpers\FileChecker;
use Core\ControllerLoaders\CoreControllerLoader;

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
        }
        //var_dump($this->explodedUrl);
        //var_dump($this->controller);
        $toSend = new \stdClass();
        $toSend->test = "Test value";
        $this->controller->sendJson($toSend);
    }

    /**
     * @param array $url
     */
    protected function getController(array $url)
    {
        $this->controller = $this->controllerLoader->produceController($this->explodedUrl);
    }
}