<?php

declare(strict_types=1);

namespace Controllers;

use Controllers\RequestController;
use Exceptions\DatabaseException;
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


    //download users data from database fun
    public function downloadUsersData(): array
    {
        $pdo = $this->requestController->connect();
        $stm = $pdo->prepare("SELECT * FROM users");
        $stm->execute();
        $data = $stm->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($data)) {
            return $data;
        } else echo "Nie można pobrać użytkowników z bazy danych";
    }
}
