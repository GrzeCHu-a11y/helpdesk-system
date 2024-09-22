<?php

declare(strict_types=1);

namespace Controllers;

use Controllers\RequestController;
use DateTime;
use PDOException;

class WorktimeController
{
    private RequestController $requestController;

    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->requestController = new RequestController();
        $this->handleAction();
    }

    private function handleAction(): void
    {
        //prepare params for send to db
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->prepareParams();
        }
    }

    private function prepareParams(): void
    {
        if (!isset($_SESSION["PARAMS_FROM_WORK_FORM"])) {
            $_SESSION["PARAMS_FROM_WORK_FORM"] = ["date" => "", "username" => "", "start" => "", "end" => ""];
        }

        $params = $_SESSION["PARAMS_FROM_WORK_FORM"];

        if (isset($_POST["registerIn"])) {

            $date = (date("Y-m-d"));
            $username = $_SESSION["USER_DATA"]["username"];
            $startTime = date("H:i");

            $params["start"] = $startTime;
            $params["username"] = $username;
            $params["date"] = $date;

            $_SESSION["PARAMS_FROM_WORK_FORM"] = $params;

            $_SESSION["CONSTANT_MESSAGES"] = ["message" => "czas rejestrowany od: ", "start" => "$startTime"];
        }

        if (isset($_POST["registerOut"])) {

            $outTime = date("H:i");
            $params["end"] = $outTime;

            $_SESSION["PARAMS_FROM_WORK_FORM"] = $params;

            if (!empty($params["start"] && $params["end"] && $params["date"])) {
                $this->sendData($params);
            }
        }
    }

    private function sendData(array $params): void
    {
        try {
            $uid = $_SESSION["USER_DATA"]["id"];
            $date = $params["date"];
            $username = $params["username"];
            $start = $params["start"];
            $end = $params["end"];
            $sum = $this->calculateTime($start, $end);

            $pdo = $this->requestController->connect();
            $stm = $pdo->prepare("INSERT INTO worktime (user_id, date, username, time_start, time_end, time_sum) VALUES (:user_id, :date, :username, :time_start, :time_end, :time_sum)");

            $stm->execute([
                ":user_id" => $uid,
                ":date" => $date,
                ":username" => $username,
                ":time_start" => $start,
                ":time_end" => $end,
                ":time_sum" => $sum,
            ]);

            $_SESSION["MESSAGES"] = ["message" => "dane zapisane"];

            //clear session and constatnt messages
            unset($_SESSION["CONSTANT_MESSAGES"]);
            unset($_SESSION["PARAMS_FROM_WORK_FORM"]);
            // $_SESSION["PARAMS_FROM_WORK_FORM"] = ["date" => "", "username" => "", "start" => "", "end" => ""];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    private function calculateTime(string $start, string $end): string
    {
        $startTime = DateTime::createFromFormat('H:i', $start);
        $endTime = DateTime::createFromFormat('H:i', $end);

        $interval = $startTime->diff($endTime);

        return $interval->format('%H:%I');
    }
}
