<?php

$asideArray =
    [
        "dashboard" => [
            "wydrukuj raport" => "/?route=raport",
            "menu d 2" => "/?route=raport",
            "menu d 3" => "/?route=raport",
        ],

        "tickets" => [
            "wszystkie zgłoszenia" => "/?route=raport",
            "rozwiązane zgłoszenia" => "/?route=raport",
            "usunięte zgłoszenia" => "/?route=raport",
        ],

        "ticket" => [
            "konwersacja" => "/?route=raport",
            "pliki" => "/?route=raport",
            "menu t 3" => "/?route=raport",
        ],

        "team" => [
            "menu t 1" => "/?route=raport",
            "menu t 2" => "/?route=raport",
            "menu t 3" => "/?route=raport",
        ],

        "worktime" => [
            "menu t 1" => "/?route=raport",
            "menu t 2" => "/?route=raport",
            "menu t 3" => "/?route=raport",
        ],

    ];

$newAsideArrayState = [];

if (array_key_exists($currPage, $asideArray)) {
    $newAsideArrayState = $asideArray[$currPage];
    return $newAsideArrayState;
}
