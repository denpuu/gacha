<?php

define('PUBLIC_DIR', __DIR__);
define('APP_DIR', dirname(PUBLIC_DIR) . '/app');
define('CLASS_DIR', APP_DIR . '/classes');

require_once(APP_DIR . '/autoloader.php');

$autoloader = new Autoloader(CLASS_DIR . '/');
$autoloader->load();

try {
    $controller = new \controller\Gacha();
    $res = $controller->exec();

    echo $res;
} catch(\Exception $e) {
    echo $e->getMessage();
}
