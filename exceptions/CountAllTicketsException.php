<?php

declare(strict_types=1);

namespace Exceptions;

use Exception;

class CountAllTicketsException extends Exception
{
    public function __construct()
    {
        $this->handleErr();
    }
    protected function handleErr()
    {
        echo "Błąd podczas pobierania liczby zgłoszeń /";
    }
}
