<?php

declare(strict_types=1);

if (!isset($_SESSION)) {
    session_start();
}

ob_start();

require_once("helpers/asideArray.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HDESK</title>
    <link href="https://cdn.jsdelivr.net/npm/fastbootstrap@2.2.0/dist/css/fastbootstrap.min.css" rel="stylesheet" integrity="sha256-V6lu+OdYNKTKTsVFBuQsyIlDiRWiOmtC8VQ8Lzdm2i4=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid">
            <?php if (isset($_SESSION["USER_DATA"]["username"])) : ?>
                <a class="navbar-brand" href="/?route=dashboard">
                    <img src="public/logo.png" width=" 80" />
                </a>
            <?php else : ?>
                <a class="navbar-brand" href="/">
                    <img src="public/logo.png" width=" 80" />
                </a>
            <?php endif; ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav me-auto">
                    <?php if (isset($_SESSION["USER_DATA"]["username"])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/?route=dashboard">Panel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/?route=tickets">Zgłoszenia</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/?route=team">Zespół</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/?route=worktime">Czas pracy</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/">Strona Główna</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">O Systemie</a>
                        </li>
                    <?php endif; ?>
                </div>
            </div>
            <div class="navbar-nav ms-auto">
                <?php if (isset($_SESSION["USER_DATA"]["username"])) : ?>
                    <div class="d-flex flex-row gap-4 me-8">
                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle" style="font-size: 1.5rem; margin-right: 4px;"></i>
                                <strong><?php echo htmlspecialchars($_SESSION["USER_DATA"]["username"], ENT_QUOTES); ?></strong>
                            </a>
                            <ul class="dropdown-menu text-small shadow">
                                <li><a class="dropdown-item" href="#">Ustawienia</a></li>
                                <li><a class="dropdown-item" href="#">Profil</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="helpers/logout.php">Wyloguj</a></li>
                            </ul>
                        </div>
                    </div>
                <?php else : ?>
                    <button type="button" class="btn btn-dark me-3">
                        <a class="text-white text-decoration-none" href="/?route=login">Zaloguj</a>
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main class="<?php echo isset($_SESSION["USER_DATA"]["username"]) ? "main" : "main-full"; ?>">
        <?php if (isset($_SESSION["USER_DATA"]["username"])) : ?>
            <aside class="sidebar">
                <ul class="list-group border-0" style="width:100%;">
                    <li class="list-group-item">
                        <p>Akcje</p>
                    </li>
                    <?php foreach ($newAsideArrayState as $key => $el) { ?>
                        <li class="list-group-item list-group-item-action"><a class="nav-link" href="<?php echo htmlspecialchars($el, ENT_QUOTES); ?>"><?php echo htmlspecialchars($key, ENT_QUOTES); ?></a></li>
                    <?php } ?>
                </ul>
            </aside>
        <?php endif; ?>

        <div class="<?php echo isset($_SESSION["USER_DATA"]["username"]) ? "content" : "content-full"; ?>" id="pagesContent">
            <?php
            $fileMainPage = "pages/main/$currPage.php";
            $fileSubPage = "pages/sub/$currPage.php";

            if (file_exists($fileMainPage)) {
                require_once("pages/main/$currPage.php");
            } elseif (file_exists($fileSubPage)) {
                require_once("pages/sub/$currPage.php");
            }
            ?>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>

<?php
ob_end_flush();
// ob_end_clean();
?>