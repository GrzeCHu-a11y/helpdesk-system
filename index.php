<?php

declare(strict_types=1);

use Controllers\RoutingController;

error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once __DIR__ . '/vendor/autoload.php';

$router = new RoutingController();
$router->run();

function dump($data)
{
    echo '<div 
    style="
      position: fixed;
      top: 10px;
      right: 10px;
      width: 300px;
      max-height: 90vh;
      overflow-y: auto;
      padding: 10px;
      border: 1px solid gray;
      background: lightgray;
      z-index: 9999;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      word-wrap: break-word;
    "
  >
  <pre>';
    var_dump($data);
    echo '</pre>
  </div>';
}
