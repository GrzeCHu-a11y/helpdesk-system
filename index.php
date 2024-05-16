<?php

declare(strict_types=1);

require_once("controllers/RoutingController.php");

$router = new RoutingController();
$router->run();
