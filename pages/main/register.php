<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <section>
        <h2>Utwórz nowego użytkowika</h2>
        <br>
        <form method="post">
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail3" name="email">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputUsername3" class="col-sm-2 col-form-label">Nazwa użytkowika</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputUsername3" name="username">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Hasło</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword3" name="password">
                </div>
            </div>
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Przypisz Role</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="role" id="gridRadios1" value="asystent">
                        <label class="form-check-label" for="gridRadios1">
                            Asystent
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="role" id="gridRadios2" value="kierownik">
                        <label class="form-check-label" for="gridRadios2">
                            Kierowonik zespołu
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="role" id="gridRadios3" value="wsparcie techniczne">
                        <label class="form-check-label" for="gridRadios3">
                            Pracownik wsparcia technicznego
                        </label>
                    </div>
                </div>
            </fieldset>

            <button type="submit" class="btn btn-primary">Stwórz</button>
        </form>
    </section>
</body>

</html>