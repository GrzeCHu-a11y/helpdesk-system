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
        $this->requestController->connect();
    }
}
