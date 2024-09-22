<?php

declare(strict_types=1);

namespace Exceptions;

use Exception;

class DatabaseException extends Exception
{
    public function __construct()
    {
        $_SESSION["MESSAGES"]["message"] = "Nie udało się pobrać danych / czas pracy musi zostać zarejestrowany przynajmniej 1 raz";
    }
}
