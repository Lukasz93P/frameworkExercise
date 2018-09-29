<?php
declare(strict_types=1);

namespace Application\Controllers;

use Core\Controller\CoreController;

class Start extends CoreController
{
    public function index()
    {
        echo get_called_class();
    }
}