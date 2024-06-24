<?php

declare(strict_types=1);

namespace Controllers;

use Controllers\RequestController;
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
        $stm->execute([":id" => $id]);
        $data = $stm->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function sendMessageFromTicket(array $data): void
    {
        $pdo = $this->requestController->connect();
        $stm = $pdo->prepare("INSERT INTO tickets_messages (ticket_id, user_id, message, username) VALUES (:ticket_id, :user_id, :message, :username)");
        $stm->execute([
            ":ticket_id" => $data["ticket_id"],
            ":user_id" => $data["user_id"],
            ":message" => $data["message"],
            ":username" => $data["username"],
        ]);
        return;
    }

    public function downloadTicketMessages(int $id): array
    {
        $pdo = $this->requestController->connect();
        $stm = $pdo->prepare("SELECT * FROM tickets_messages WHERE ticket_id = :ticket_id");
        $stm->execute([":ticket_id" => $id]);
        $data = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}
