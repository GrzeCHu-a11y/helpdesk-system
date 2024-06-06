<?php

declare(strict_types=1);

use Controllers\RoutingController;

require_once("controllers/RoutingController.php");

$router = new RoutingController();
$router->run();
