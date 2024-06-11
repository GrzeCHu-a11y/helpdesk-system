<?php

declare(strict_types=1);

namespace Controllers;

use Controllers\RequestController;

class WorktimeController
{
    private RequestController $requestController;

    public function __construct()
    {
        $this->requestController = new RequestController();
    }

    public function prepareParams()
    {
        if (!isset($_SESSION["PARAMS_FROM_WORK_FORM"])) {
            $_SESSION["PARAMS_FROM_WORK_FORM"] = ["date" => "", "username" => "", "start" => "", "end" => ""];
        }

        $params = $_SESSION["PARAMS_FROM_WORK_FORM"];

        if (!empty($_POST["registerIn"])) {

            $date = (date("Y-m-d"));
            $username = $_SESSION["username"];
            $startTime = $_POST["registerIn"];

            $params["start"] = $startTime;
            $params["username"] = $username;
            $params["date"] = $date;

            $_SESSION["PARAMS_FROM_WORK_FORM"] = $params;

            echo "czas rejestrowany";
        }

        if (!empty($_POST["registerOut"])) {

            $outTime = $_POST["registerOut"];
            $params["end"] = $outTime;

            $_SESSION["PARAMS_FROM_WORK_FORM"] = $params;

            if (!empty($params["start"] && $params["end"] && $params["date"])) {
                $this->sendData($params);
            }
        }
    }

    private function sendData(array $params)
    {
        $uid = $_SESSION["USER_DATA"]["id"];
        $date = $params["date"];
        $username = $params["username"];
        $start = $params["start"];
        $end = $params["end"];

        $pdo = $this->requestController->connect();
        $stm = $pdo->prepare("INSERT INTO worktime (user_id, date, username, time_start, time_end) VALUES (:user_id, :date, :username, :time_start, :time_end)");

        $stm->execute([
            ":user_id" => $uid,
            ":date" => $date,
            ":username" => $username,
            ":time_start" => $start,
            ":time_end" => $end,
        ]);

        echo "dane zapisane";

        //clear session
        $_SESSION["PARAMS_FROM_WORK_FORM"] = ["date" => "", "username" => "", "start" => "", "end" => ""];
    }
}
