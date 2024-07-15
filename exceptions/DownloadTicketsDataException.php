<?php

declare(strict_types=1);

namespace Exceptions;

use Exception;

class DownloadTicketsDataException extends Exception
{
    public function __construct()
    {
        $this->handleErr();
    }

    private function handleErr(): void
    {
        echo "Nie można pobrac danych zgłoszeń";
    }
}
