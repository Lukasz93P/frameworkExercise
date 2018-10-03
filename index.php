<?php
declare(strict_types=1);

use Core\Session\Session;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'secrets.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'Config.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR .  'core' . DIRECTORY_SEPARATOR .'config' . DIRECTORY_SEPARATOR . 'config.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

Session::start(null, 300);

$xmlConfigPath = __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.xml';
$config = new Config($xmlConfigPath);
$config->config();
$core = $config->getObject('Core');