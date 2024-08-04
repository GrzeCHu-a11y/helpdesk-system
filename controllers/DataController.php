<?php

declare(strict_types=1);

namespace Controllers;

use Controllers\RequestController;
use Exceptions\CountAllTicketsException;
use Exceptions\DatabaseException;
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
        if (!isset($_SESSION)) {
            session_start();
        }
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
                throw new DatabaseException();
            }
        } catch (DatabaseException $e) {
            echo $e->getMessage();
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
        } catch (DownloadTicketsDataException $e) {
            echo $e->getMessage();
            return [];
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
            return $count = 0;
        }
    }

    public function countClosedTickets(): int
    {
        $pdo = $this->requestController->connect();
        $stm = $pdo->prepare("SELECT COUNT(*) FROM tickets WHERE status='Zamknięte'");
        $stm->execute();
        $count = $stm->fetchColumn();

        if ($count > 0) {
            return $count;
        } else return $count = 0;
    }

    public function search($table, $dbItemName, $phrase): array
    {
        $searchPhrase = "%$phrase%";

        $pdo = $this->requestController->connect();
        $stm = $pdo->prepare("SELECT * FROM $table WHERE $dbItemName LIKE :phrase");
        $stm->execute([
            ":phrase" => $searchPhrase,
        ]);

        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countTicketTypes(): array
    {
        $pdo = $this->requestController->connect();
        $pdo->beginTransaction();

        try {
            $types = ["INNE", "SPRZĘT", "APLIKACJA", "BEZPIECZEŃSTWO", "UŻYTKOWNIK", "INTERNET"];
            $counts = [];

            $stm = $pdo->prepare("SELECT type, COUNT(*) as count FROM tickets WHERE type IN(?, ?, ?, ? ,?, ?) GROUP BY type");
            $stm->execute($types);

            $results = $stm->fetchAll(PDO::FETCH_ASSOC);

            //reset array
            foreach ($types as $type) {
                $counts[$type] = 0;
            }

            foreach ($results as $row) {
                $counts[$row["type"]] = $row["count"];
            }

            $pdo->commit();

            if (array_sum($counts) > 1) {
                return $counts;
            } else throw new GetTicketTypesException();
        } catch (GetTicketTypesException $e) {
            echo $e->getMessage();
            return array_fill_keys($counts, 0);
        }
    }
}
