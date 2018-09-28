<?php
declare(strict_types=1);

use Core\Core;
use Core\ControllerLoaders\CoreControllerLoader;

require_once __DIR__ . '/vendor/autoload.php';

$core = new Core(new CoreControllerLoader());
