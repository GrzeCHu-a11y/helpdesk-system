<?php

declare(strict_types=1);

namespace Exceptions;

use Exception;

class GetTicketTypesException extends Exception
{
    public function __construct()
    {
        $this->handleErr();
    }

    private function handleErr(): void
    {
        echo "Nie można pobrać typów zgłoszeń";
    }
}
