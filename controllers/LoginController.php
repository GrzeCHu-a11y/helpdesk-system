<?php

declare(strict_types=1);

namespace Controllers;

use PDO;

class LoginController
{
    private array $data;
    private RequestController $requestController;

    public function __construct()
    {
        $this->requestController = new RequestController();
        $this->handleLogin();
    }

    private function handleLogin(): void
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data = [
                "username" => filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING),
                "password" => filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING),
            ];

            if (!empty($data)) {
                $this->data = $data;
                $this->login();
            }
        }
    }

    private function login(): void
    {
        $username = $this->data["username"];
        $password = $this->data["password"];

        $pdo = $this->requestController->connect();

        if ($this->validateUser($pdo, $username, $password)) {
            session_start();
            $_SESSION["username"] = $username;

            header("Location: /?route=dashboard");
            exit;
        } else {
            echo "Podany użytkownik nie istnieje";
        }
    }

    private function validateUser(PDO $pdo, string $username, string $password): bool
    {
        $stm = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stm->execute(["username" => $username]);
        $user = $stm->fetch();

        //set user data to SESSION
        $_SESSION["USER_DATA"] = $user;

        if ($user && password_verify($password, $user["password"])) {
            return true;
        }

        return false;
    }
}
