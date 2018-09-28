<?php
declare(strict_types=1);

namespace Application\Controllers;

use Core\Cacher\CacherInterface;
use Core\Controller\CoreController;

class Start extends CoreController
{
    public function __construct(CacherInterface $cacher)
    {
        parent::__construct($cacher);
        echo "DFF";
    }

    public function index()
    {
        echo get_called_class();
    }
}