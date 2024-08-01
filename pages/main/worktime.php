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
        <?php if (isset($_SESSION["CONSTANT_MESSAGES"])) : ?>
            <div class="alert alert-primary" role="alert">
                <?php echo $_SESSION["CONSTANT_MESSAGES"]["message"], $_SESSION["CONSTANT_MESSAGES"]["start"] ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION["MESSAGES"])) : ?>

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $_SESSION["MESSAGES"]["message"] ?>
                <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <?php unset($_SESSION["MESSAGES"]); ?>
        <?php endif; ?>


        <br><br>
        <div class="d-flex flex-row gap-3 align-items-center">
            <form method="post">
                <button type="submit" id="startBtn" class="btn btn-success" name="registerIn">Zarejestruj wejście</button>
                <button type="submit" id="stopBtn" class="btn btn-danger" name="registerOut">Zarejestruj wyjście</button>
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
                        <td><?php echo $row["time_sum"] ?></td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>

    </section>

</body>

</html>