<?php

declare(strict_types=1);
require_once("db/dbconfig.php");

class RequestController
{
    public function getParams(): string
    {
        if (!empty($_GET)) {
            return $_GET["route"];
        } else return "home";
    }

    public function connect(): void
    {
        try {
            $dsn = Config::getDsn();
            $pdo = new PDO($dsn, Config::$user, Config::$pass, Config::$options);
            echo "conn succes";
        } catch (\PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }
}
