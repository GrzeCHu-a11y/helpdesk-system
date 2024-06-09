<?php

declare(strict_types=1);

namespace Controllers;

class WorktimeController
{
    public function prepareParams()
    {
        $params = ["date" => "", "username" => "", "start" => "", "end" => ""];

        if (!empty($_POST["registerIn"])) {

            $date = (date("Y-m-d"));
            $username = $_SESSION["username"];
            $startTime = $_POST["registerIn"];

            $params["start"] = $startTime;
            $params["username"] = $username;
            $params["date"] = $date;

            $_SESSION["PARAMS_FROM_WORK_FORM"] = $params;

            $this->sendData();
        }

        if (!empty($_POST["registerOut"])) {

            $outTime = $_POST["registerOut"];
            $params["end"] = $outTime;
        }
    }

    protected function sendData()
    {
        var_dump($_SESSION);
    }
}
