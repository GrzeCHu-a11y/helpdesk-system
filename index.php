<?php

declare(strict_types=1);

use Controllers\RoutingController;

require_once __DIR__ . '/vendor/autoload.php';

$router = new RoutingController();
$router->run();
