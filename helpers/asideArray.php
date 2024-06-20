<?php
$ticketID = isset($_GET["id"]) ? $_GET["id"] : null;

$asideArray =
    [
        "dashboard" => [
            "Utwórz nowy raport" => "",
            "Raporty" => "",
            "Utwórz nowy schemat" => "",
            "Schematy" => "",
        ],

        "tickets" => [
            "Wszystkie zgłoszenia" => "",
            "Aktywne zgłoszenia" => "",
            "Rozwiązane zgłoszenia" => "",
            "Usunięte zgłoszenia" => "",
            "Drukuj" => "",
        ],

        "ticket" => [
            "Pliki" => "",
        ],

        "team" => [
            "Wygeneruj raport aktywności zespołu" => "",
            // "Wygeneruj miesięczny raport pracy" => "",
        ],

        "worktime" => [
            "Drukuj" => "",
        ],

    ];

if ($ticketID) {
    $asideArray["ticket"]["Konwersacja"] = "/?route=ticket&id=$ticketID";
}

$newAsideArrayState = [];

if (array_key_exists($currPage, $asideArray)) {
    $newAsideArrayState = $asideArray[$currPage];
    return $newAsideArrayState;
}
