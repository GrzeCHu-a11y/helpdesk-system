<?php

declare(strict_types=1);

namespace Controllers;

use Controllers\RequestController;
use Exceptions\CountAllTicketsException;
use Exceptions\DatabaseException;
use Exceptions\DownloadTicketDataException;
use Exceptions\DownloadUsersDataException;
use Exceptions\DownloadTicketsDataException;
use Exceptions\GetTicketTypesException;
use PDO;

class DataController
{
    private RequestController $requestController;

    public function __construct()
    {
        $this->requestController = new RequestController();
    }

    //download worktime log from database fun
    public function downloadWorktimeData(): array
    {
        try {
            $uid = $_SESSION["USER_DATA"]["id"];

            $pdo = $this->requestController->connect();
            $stm = $pdo->prepare("SELECT * FROM worktime WHERE user_id = :user_id");
            $stm->execute([
                ":user_id" => $uid,
            ]);
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($data)) {
                return $data;
            } else {
                throw new DatabaseException("Nie udało się pobrać danych / czas pracy musi zostać zarejestrowany przynajmniej 1 raz");
            }
        } catch (DatabaseException $e) {
            echo 'Message: ' . $e->getMessage();
            return [];
        }
    }

    //download users data from database fun // TO DO: add LIMIT
    public function downloadUsersData(): array
    {
        try {
            $pdo = $this->requestController->connect();
            $stm = $pdo->prepare("SELECT * FROM users");
            $stm->execute();
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($data)) {
                return $data;
            } else {
                throw new DownloadUsersDataException();
            }
        } catch (DownloadUsersDataException $e) {
            echo $e->getMessage();
        }
    }

    //download tickets from database fun
    public function downloadTicketsData(): array
    {
        try {
            $pdo = $this->requestController->connect();
            $stm = $pdo->prepare("SELECT * FROM tickets");
            $stm->execute();
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($data)) {
                return $data;
            } else {
                throw new DownloadTicketsDataException();
            }
        } catch (DownloadTicketDataException $e) {
            echo $e->getMessage();
        }
    }

    public function countTicketTypes(): array
    {
        $pdo = $this->requestController->connect();
        $pdo->beginTransaction();

        try {
            $stm = $pdo->prepare("SELECT COUNT(*) FROM tickets WHERE type='INNE'");
            $stm->execute();
            $countINNE = $stm->fetchColumn();

            $stm = $pdo->prepare("SELECT COUNT(*) FROM tickets WHERE type='SPRZĘT'");
            $stm->execute();
            $countSPRZET = $stm->fetchColumn();

            $stm = $pdo->prepare("SELECT COUNT(*) FROM tickets WHERE type='INTERNET'");
            $stm->execute();
            $countINTERNET = $stm->fetchColumn();

            $pdo->commit();

            if ($countINNE || $countSPRZET ||  $countINTERNET >= 1) {
                return $data = ["INNE" => $countINNE, "SPRZET" => $countSPRZET, "INTERNET" => $countINTERNET];
            } else throw new GetTicketTypesException();
        } catch (GetTicketTypesException $e) {
            echo $e->getMessage();
        }
    }

    public function countAllTickets(): int
    {
        try {
            $pdo = $this->requestController->connect();
            $stm = $pdo->prepare("SELECT COUNT(*) FROM tickets");
            $stm->execute();
            $count = $stm->fetchColumn();

            if ($count > 0) {
                return $count;
            } else throw new CountAllTicketsException();
        } catch (CountAllTicketsException $e) {
            echo $e->getMessage();
        }
    }

    public function countClosedTickets(): int
    {
        try {
            $pdo = $this->requestController->connect();
            $stm = $pdo->prepare("SELECT COUNT(*) FROM tickets WHERE status='Zamknięte'");
            $stm->execute();
            $count = $stm->fetchColumn();

            if ($count > 0) {
                return $count;
            } else throw new CountAllTicketsException();
        } catch (CountAllTicketsException $e) {
            echo $e->getMessage();
        }
    }
}
