<?php
declare(strict_types=1);

namespace Core\Methodselection;

use Core\Methodselection\MethodSelectorInterface;
use Core\Controller\CoreController;

class CoreMethodSelector implements MethodSelectorInterface
{
    /**
     * @param CoreController $controller
     * @param array $url
     * @return mixed
     */
    public function selectMethod(CoreController $controller, array &$url)
    {
        $methodName = $url[0];
        if (method_exists($controller, $methodName)) {
            array_shift($url);
            return $methodName;
        }
    }
}