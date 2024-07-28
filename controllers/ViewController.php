<?php

declare(strict_types=1);

namespace Controllers;

class ViewController
{
    public function render(string $currPage, array $viewParams = [])
    {
        require_once("layout.php");
    }
}
