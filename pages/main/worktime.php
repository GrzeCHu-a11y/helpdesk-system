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
                <button type="submit" id="startBtn" class="btn btn-success" name="registerIn" value="<?php echo date("H:i") ?>">Zarejestruj wejście</button>
                <button type="submit" id="stopBtn" class="btn btn-danger" name="registerOut" value="<?php echo date("H:i") ?>">Zarejestruj wyjście</button>
            </form>
        </div>
        <br>
        <br>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Data</th>
                    <th scope="col">Użytkownik</th>
                    <th scope="col">Wejście</th>
                    <th scope="col">Wyjście</th>
                    <th scope="col">Suma</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($viewParams as $row) : ?>
                    <tr>
                        <th scope="row"><?php echo $row["date"] ?></th>
                        <td><?php echo $row["username"] ?></td>
                        <td><?php echo $row["time_start"] ?></td>
                        <td><?php echo $row["time_end"] ?></td>
                        <td>*w budowie*</td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>

    </section>

</body>

</html>