<?php
declare(strict_types=1);

namespace Core\ControllerLoaders;

use Core\Controller\CoreController;

interface ControllerLoaderInterface
{
    /**
     * @return string
     */
    function getControllersPath(): string;

    /**
     * @param array $url
     * @return CoreController
     */
    function produceController(array &$url): CoreController;
}