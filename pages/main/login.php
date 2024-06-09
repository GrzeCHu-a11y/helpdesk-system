<?php

declare(strict_types=1);

use Controllers\LoginController;


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = [
        "username" => filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING),
        "password" => filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING),
    ];

    $loginController = new LoginController($data);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/login.css">
    <title>Document</title>
</head>

<body>
    <section>
        <div class="login-wrapper">
            <h2>Login</h2>
            <br>
            <form method="post">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nazwa Użytownika</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username" />
                    <div id="emailHelp" class="form-text">Nigdy nie udostępnimy Twojego adresu e-mail nikomu innemu.</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Hasło</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" />
                </div>
                <!-- <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" checked />
                    <label class="form-check-label" for="exampleCheck1">Always sign in on this device</label>
                </div> -->
                <div class="text-end">
                    <button type="submit" class="btn btn-dark me-2"><a class="text-white text-decoration-none" href="/">Wstecz</a></button>
                    <button type="submit" class="btn btn-dark">Zaloguj</button>
                </div>
                <div class="mt-5">
                    <h5>Chcesz przetestować system? Wpisz te dane:</h5>
                    <p>Nazwa Użytkowika: User / Hasło: User</p>
                </div>
            </form>
        </div>
    </section>
</body>

</html>