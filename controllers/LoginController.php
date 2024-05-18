<?php

declare(strict_types=1);

class LoginController
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->handleLogin();
    }

    private function handleLogin(): void
    {
        echo $this->data["password"], $this->data["email"];
    }
}
