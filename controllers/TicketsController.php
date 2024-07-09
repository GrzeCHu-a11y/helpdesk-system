<?php

declare(strict_types=1);

namespace Controllers;

use Controllers\RequestController;
use PDO;
use PDOException;

class TicketsController
{
    private RequestController $requestController;

    public function __construct()
    {
        $this->requestController = new RequestController();
        $this->handleAction();
    }

    private function handleAction(): void
    {
        // handle delete ticket 
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete-ticket"])) {
            $ticketId = (int) $_POST["delete-ticket"];
            if (!empty($ticketId)) {
                $this->deleteTicket($ticketId);
            } else return;
        }
    }

    private function deleteTicket(int $ticket_id): void
    {
        $pdo = $this->requestController->connect();
        $pdo->beginTransaction();

        try {
            $stm = $pdo->prepare("DELETE FROM tickets_messages WHERE ticket_id = :ticket_id");
            $stm->execute([":ticket_id" => $ticket_id]);

            $stm = $pdo->prepare("DELETE FROM tickets WHERE id = :ticket_id");
            $stm->execute([":ticket_id" => $ticket_id]);

            $pdo->commit();
            echo "Rekord został pomyślnie usunięty.";
        } catch (PDOException $e) {
            $pdo->rollBack();
            echo "Błąd przy usuwaniu rekordu: " . $e->getMessage();
        }
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
