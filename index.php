<?php
declare(strict_types=1);

use Core\Core;
use Core\ControllerLoaders\CoreControllerLoader;
use Core\Session\Session;
use Core\Methodselection\CoreMethodSelector;
use Core\Controllercalling\CoreControllerCaller;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'secrets.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

Session::start(null, 300);
$core = new Core(new CoreControllerLoader(), new CoreMethodSelector(), new CoreControllerCaller());