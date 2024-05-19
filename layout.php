<?php

declare(strict_types=1);
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HDESK</title>
    <link href="https://cdn.jsdelivr.net/npm/fastbootstrap@2.2.0/dist/css/fastbootstrap.min.css" rel="stylesheet" integrity="sha256-V6lu+OdYNKTKTsVFBuQsyIlDiRWiOmtC8VQ8Lzdm2i4=" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <!-- nav -->
    <nav class="navbar navbar-expand-lg">
        <div class="container" id="container-navbar">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarButtonsExample" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php if (isset($_SESSION["username"])) : ?>
                <a class="navbar-brand" href="/?route=dashboard">
                    <img src="public/logo.png" width=" 70" />
                </a>
            <?php else : ?>
                <a class="navbar-brand" href="/">
                    <img src="public/logo.png" width=" 70" />
                </a>
            <?php endif; ?>
            <div class="collapse navbar-collapse" id="navbarButtonsExample">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Strona Główna</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">O Systemie</a>
                    </li>
                    <?php if (isset($_SESSION["username"])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/?route=dashboard">Panel</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <div class="d-flex align-items-center ms-auto">
                    <button type="button" class="btn btn-default me-3">
                        <a href="/?route=login">Zaloguj</a>
                    </button>
                    <?php if (isset($_SESSION["username"])) : ?>
                        <button type="button" class="btn btn-default me-3">
                            <a href="helpers/logout.php">Wyloguj</a>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    <!-- nav -->

    <main>
        <?php if (isset($_SESSION["username"])) : ?>
            <aside class="sidebar">
                <ul class="list-group border-0" style="width:100%;">
                    <li class="list-group-item">
                        <p>Menu 0</p>
                    </li>
                    <li class="list-group-item list-group-item-action">
                        <a href="#">Menu 1</a>
                    </li>
                    <li class="list-group-item list-group-item-action">
                        <a href="#">Menu 2</a>
                    </li>
                    <li class="list-group-item list-group-item-action">
                        <a href="#">Menu 3</a>
                    </li>
                    <li class="list-group-item list-group-item-action">
                        <a href="#">Menu 4</a>
                    </li>
                </ul>
            </aside>
        <?php endif; ?>

        <div class="content">
            <?php require_once("pages/$currPage.php") ?>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>