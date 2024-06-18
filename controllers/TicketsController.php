<?php

declare(strict_types=1);

namespace Controllers;

use Controllers\RequestController;
use Controllers\RoutingController;

class TicketsController
{
    private RequestController $requestController;

    public function __construct()
    {
        $this->requestController = new RequestController();
    }

    public function deleteTicket(int $id)
    {
        $pdo = $this->requestController->connect();
        $stm = $pdo->prepare("DELETE FROM tickets WHERE id = :id");
        $stm->execute(["id" => $id]);
    }
}
