<?php

declare(strict_types=1);

use Controllers\RoutingController;

error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once __DIR__ . '/vendor/autoload.php';

$router = new RoutingController();
$router->run();
