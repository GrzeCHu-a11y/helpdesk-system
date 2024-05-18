<?php

declare(strict_types=1);
require_once("controllers/LoginController.php");


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = ["username" => $_POST["username"], "password" => $_POST["password"]];

    $loginController = new LoginController($data);
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
        <h2>Login</h2>
        <br>
        <form method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username" />
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Hasło</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" />
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" checked />
                <label class="form-check-label" for="exampleCheck1">Always sign in on this device</label>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-subtle me-2">Wstecz</button>
                <button type="submit" class="btn btn-primary">Wyślij</button>
            </div>
        </form>
    </section>
</body>

</html>