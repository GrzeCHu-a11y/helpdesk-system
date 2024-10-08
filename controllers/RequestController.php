<?php

declare(strict_types=1);

namespace Controllers;

use DBconfig\Config;
use PDO;
use PDOException;

require_once("db/dbconfig.php");



class RequestController
{
    public function getParams(): string
    {
        if (!empty($_GET)) {
            return $_GET["route"];
        } else return "home";
    }

    public function connect(): PDO
    {
        try {
            $dsn = Config::getDsn();
            $pdo = new PDO($dsn, Config::$user, Config::$pass, Config::$options);
            return $pdo;
        } catch (\PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }
}
