<?php
declare(strict_types=1);

namespace Application\Controllers\Contentlist;

use Core\Controller\CoreController;

class Listing extends CoreController
{

    public function index()
    {
        $data = ['content' => 'nested', 'title' => 'NESTED TEST'];
        $this->sendView('test', $data);
    }
}