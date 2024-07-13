<?php

declare(strict_types=1);

namespace Exceptions;

use Exception;

class DownloadUsersDataException extends Exception
{
    protected function __construct()
    {
        $this->handleErr();
    }

    private function handleErr(): void
    {
        echo "Nie można pobrac danych użytkowników";
    }
}
