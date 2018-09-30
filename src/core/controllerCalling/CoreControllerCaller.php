<?php
declare(strict_types=1);

namespace Core\Controllercalling;

use Core\Controller\CoreController;
use Core\Controllercalling\ControllerCallerInterface;

class CoreControllerCaller implements ControllerCallerInterface
{
    /**
     * @param CoreController $controller
     * @param string $method
     * @param array|null $url
     * @return mixed|void
     */
    public function callController(CoreController $controller, string $method, array &$url = null)
    {
        call_user_func_array([$controller, $method], $url);
    }
}