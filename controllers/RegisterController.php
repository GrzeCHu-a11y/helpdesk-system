<?php

declare(strict_types=1);

namespace Controllers;

use PDO;

class RegisterController
{
    private array $data;
    private RequestController $requestController;

    public function __construct()
    {
        $this->requestController = new RequestController();
        $this->handleRegister();
    }

    private function handleRegister(): void
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data = [
                "username" => filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING),
                "password" => filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING),
                "email" => filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL),
                "role" => filter_input(INPUT_POST, "role", FILTER_SANITIZE_STRING),
            ];

            if (!empty($data)) {
                $this->data = $data;
                $this->registerUser();
            }
        }
    }

    private function registerUser(): void
    {
        $username = $this->data["username"];
        $email = $this->data["email"];
        $password = $this->data["password"];
        $role = $this->data["role"];

        if ($this->validateInput($username, $email, $password, $role)) {
            echo "Formularz nie może byc pusty";
            return;
        }

        $pdo = $this->requestController->connect();

        if ($this->userExist($pdo, $username, $email)) {
            echo "Użytkownik o podanym adresie email bądz nazwie Użytkownika istnieje";
            return;
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $stm = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)");
        $stm->execute([
            ":username" => $username,
            ":email" => $email,
            ":password" => $passwordHash,
            ":role" => $role
        ]);

        echo "Pomyślnie utworzono użytkownika";
    }

    private function validateInput(string $username, string $email, string $password, string $role): bool
    {
        if (empty($username) || empty($email) || empty($password) || empty($role)) {
            return true;
        }

        return false;
    }

    private function userExist(PDO $pdo, string $username, string $email): bool
    {
        $stm = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username OR email = :email");
        $stm->execute([":username" => $username, ":email" => $email]);

        $count = $stm->fetchColumn();

        return $count > 0;
    }
}
