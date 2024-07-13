<?php

declare(strict_types=1);

namespace Exceptions;

use Exception;

class DownloadTicketDataException extends Exception
{
    public function __construct()
    {
        $this->handleErr();
    }
    protected function handleErr()
    {
        echo "Błąd pobierania danych zgłoszenia /";
    }
}
