<?php

declare(strict_types=1);
require_once("RequestController.php");

class LoginController
{
    private array $data;
    private RequestController $requestController;

    public function __construct(array $data)
    {
        $this->requestController = new RequestController();

        $this->data = $data;
        $this->handleLogin();
    }

    private function handleLogin(): void
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

        if ($user && password_verify($password, $user["password"])) {
            return true;
        }

        return false;
    }
}
