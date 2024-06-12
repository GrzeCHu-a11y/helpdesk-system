<?php

declare(strict_types=1);

namespace Controllers;

use Controllers\RequestController;
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
        $uid = $_SESSION["USER_DATA"]["id"];

        $pdo = $this->requestController->connect();
        $stm = $pdo->prepare("SELECT * FROM worktime WHERE user_id = :user_id");
        $stm->execute([
            ":user_id" => $uid,
        ]);
        $data = $stm->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function downloadUsersData(): array
    {
        $pdo = $this->requestController->connect();
        $stm = $pdo->prepare("SELECT * FROM users");
        $stm->execute();
        $data = $stm->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }
}
