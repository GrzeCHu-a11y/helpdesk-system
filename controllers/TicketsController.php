<?php

declare(strict_types=1);

namespace Controllers;

use Controllers\RequestController;
use Exceptions\DeleteTicketException;
use Exceptions\DownloadTicketDataException;
use PDO;


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

        // handle send message
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION)) {
            if (!empty($_POST['message'])) {
                $id = $_GET["id"];
                $data = [
                    'ticket_id' => $id,
                    'user_id' => $_SESSION['USER_DATA']['id'],
                    'message' => $_POST['message'],
                    'username' => $_SESSION['USER_DATA']['username']
                ];
                $this->sendMessageFromTicket($data);
                header("Location: ?route=ticket&id=$id");
                exit();
            }
        }

        // handle change ticket status
        if ($_SERVER["REQUEST_METHOD"] === 'POST' && isset($_POST["status"]) && isset($_GET["id"])) {

            $data = [
                "status" => $_POST["status"],
                "openedAt" => $_POST["date"],
                "realizationTime" => $_POST["realization-time"],
                "operatedBy" => $_POST["operated-by"],
            ];

            if (isset($data)) {
                $this->changeTicketStatus($data);
            }
        }

        // add ticket
        if ($_SERVER["REQUEST_METHOD"] === 'POST' && !empty($_POST["subject-addTicket"])) {
            $data = [
                "name" => $_POST["subject-addTicket"],
                "requester" => $_POST["user-addTicket"],
                "status" => $_POST["status-addTicket"],
                "type" => $_POST["type-addTicket"],
                "requested" => $_POST["date-addTicket"],
            ];
            if (!empty($data)) {
                $this->addTicket($data);
            }
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
        } catch (DeleteTicketException $e) {
            $pdo->rollBack();
            echo "Błąd przy usuwaniu rekordu: " . $e->getMessage();
        }
    }

    public function downloadTicketData(int $id): array
    {
        $pdo = $this->requestController->connect();

        try {
            $stm = $pdo->prepare("SELECT * FROM tickets WHERE id = :id");
            $stm->execute([":id" => $id]);
            $data = $stm->fetch(PDO::FETCH_ASSOC);

            if ($data !== false && $data["id"] > 0) {
                return $data;
            } else {
                throw new DownloadTicketDataException;
            }
        } catch (DownloadTicketDataException $e) {
            echo $e->getMessage();
            return $data = ["id" => 0, "name" => "BŁĄD", "requester" => "BŁĄD"];
        }
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

        try {
            $stm = $pdo->prepare("SELECT * FROM tickets_messages WHERE ticket_id = :ticket_id");
            $stm->execute([":ticket_id" => $id]);
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);

            if (empty($data)) {
                echo "brak wiadomosci";
            }

            return $data;
        } catch (\Throwable $th) {
            echo "błąd przy pobieraniu wiadomosci" .  $th->getMessage();
        }
    }

    private function changeTicketStatus(array $data): void
    {
        $id = $_GET["id"];
        $pdo = $this->requestController->connect();
        try {
            $stm = $pdo->prepare("UPDATE tickets SET status=?, opened_at=?, realization_time=?, operated_by=? WHERE id=?");
            $stm->execute([
                $data["status"], $data["openedAt"], $data["realizationTime"], $data["operatedBy"], $id
            ]);
        } catch (\Throwable $th) {
            echo "błąd przy zmianie statusu zgloszenia" . $th->getMessage();
        }
    }

    private function addTicket(array $data): void
    {
        $pdo = $this->requestController->connect();

        try {
            $stm = $pdo->prepare("INSERT INTO tickets (name, requester, status, type, requested) VALUES (:name, :requester, :status, :type, :requested)");
            $stm->execute([
                ':name' => $data['name'],
                ':requester' => $data['requester'],
                ':status' => $data['status'],
                ':type' => $data['type'],
                ':requested' => $data['requested']
            ]);

            header("Location: /?route=tickets");
            exit();
        } catch (\Throwable $th) {
            echo "błąd prz dodawaniu nowego zgłoszenia: " . $th->getMessage();
        }
    }
}
