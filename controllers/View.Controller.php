<?php

declare(strict_types=1);

namespace Controllers;

class ViewController
{
    public function render(string $currPage)
    {
        require_once("layout.php");
    }
}
