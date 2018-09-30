<?php
declare(strict_types=1);

namespace Core\Controllercalling;

use Core\Controller\CoreController;

interface ControllerCallerInterface
{
    /**
     * @param CoreController $controller
     * @param string $method
     * @param array|null $url
     * @return mixed
     */
    public function callController(CoreController $controller, string $method, array &$url = null);

    /**
     * @param bool $callNext
     * @return mixed
     */
    public function setCallNext(bool $callNext);
}