<?php

declare(strict_types=1);

use Controllers\WorktimeController;

var_dump($_SESSION);
$worktimeController = new WorktimeController();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $worktimeController->prepareParams();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <section>
        <h2>Rejestracja czasu pracy</h2>
        <br><br>
        <div class="d-flex flex-row gap-3 align-items-center">
            <form method="post">
                <button type="submit" id="startBtn" class="btn btn-success" name="registerIn" value="<?php echo date("H:i") ?>">Zarejestruj wejscie</button>
                <button type="submit" id="stopBtn" class="btn btn-danger" name="registerOut" value="<?php echo date("H:i") ?>">Zarejestruj wyjscie</button>
            </form>
        </div>
        <br>
        <br>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Data</th>
                    <th scope="col">Użytkownik</th>
                    <th scope="col">Wejscie</th>
                    <th scope="col">Wyjscie</th>
                    <th scope="col">Suma</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">25.05.2024</th>
                    <td>Martyna Chmielewska</td>
                    <td>7:00</td>
                    <td>16:20</td>
                    <td>9.20</td>
                </tr>
                <tr>
                    <th scope="row">26.05.2024</th>
                    <td>Martyna Chmielewska</td>
                    <td>7:00</td>
                    <td>15:01</td>
                    <td>8.01</td>
                </tr>
                <tr>
                    <th scope="row">27.05.2024</th>
                    <td>Martyna Chmielewska</td>
                    <td>7:00</td>
                    <td>15:00</td>
                    <td>8.00</td>
                </tr>
            </tbody>
        </table>

    </section>

</body>

</html>