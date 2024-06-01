<?php

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
            "Konwersacja" => "/?route=ticket",
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

$newAsideArrayState = [];

if (array_key_exists($currPage, $asideArray)) {
    $newAsideArrayState = $asideArray[$currPage];
    return $newAsideArrayState;
}
