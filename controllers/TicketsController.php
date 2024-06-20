<?php

declare(strict_types=1);

namespace Controllers;

use Controllers\RequestController;
use Controllers\RoutingController;
use PDO;

class TicketsController
{
    private RequestController $requestController;

    public function __construct()
    {
        $this->requestController = new RequestController();
    }

    public function deleteTicket(int $id): void
    {
        $pdo = $this->requestController->connect();
        $stm = $pdo->prepare("DELETE FROM tickets WHERE id = :id");
        $stm->execute(["id" => $id]);
    }

    public function downloadTicketData(int $id): array
    {
        $pdo = $this->requestController->connect();
        $stm = $pdo->prepare("SELECT * FROM tickets WHERE id = :id");
        $stm->execute(["id" => $id]);
        $data = $stm->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
}
