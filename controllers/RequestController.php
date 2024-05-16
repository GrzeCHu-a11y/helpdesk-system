<?php

declare(strict_types=1);

class RequestController
{
    public function getParams(): string
    {
        if (!empty($_GET)) {
            return $_GET["route"];
        } else return "home";
    }
}
