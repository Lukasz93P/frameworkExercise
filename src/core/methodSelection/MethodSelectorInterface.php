<?php
declare(strict_types=1);

namespace Core\Methodselection;

use Core\Controller\CoreController;

interface MethodSelectorInterface
{
    /**
     * @param CoreController $controller
     * @param array $url
     * @return mixed
     */
    public function selectMethod(CoreController $controller, array &$url);
}