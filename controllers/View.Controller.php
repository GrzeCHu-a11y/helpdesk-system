<?php

declare(strict_types=1);

class ViewController
{
    public function render(string $currPage)
    {
        require_once("layout.php");
    }
}
