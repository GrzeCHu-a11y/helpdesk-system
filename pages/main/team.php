<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <section>
        <h2>Członkowie Zespołu</h2>
        <br><br>

        <form class="d-flex gap-2" role="search">
            <input class="form-control me-2" type="search" placeholder="Wyszukaj..." aria-label="Search">
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <i class="bi bi-gear"></i>
            </button>
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Filtruj Użytkowników</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Sekcja w budowie
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-subtle" data-bs-dismiss="modal">Zamknij</button>
                            <button type="button" class="btn btn-primary">Zapisz</button>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-subtle bg-dark" type="submit">
                <i class="bi bi-search text-light"></i>
            </button>
        </form>
        <br><br>

        <div class="table-responsive">
            <table class="table table-hover table-borderless">
                <thead class="table-dark">
                    <tr>
                        <th>Imię</th>
                        <th>Rola</th>
                        <th>Status</th>
                        <th>0</th>
                        <th>Akcja</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <tr>
                        <td>
                            <span class="avatar"><i class="fas fa-user"></i></span>
                            <a href="#">George Washington</a>
                        </td>
                        <td>CEO</td>
                        <td>Offline</td>
                        <td>0</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Więcej</button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="#">Opcja1</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="avatar"><i class="fas fa-user"></i></span>
                            <a href="#">John Adams</a>
                        </td>
                        <td>Admin</td>
                        <td>Online</td>
                        <td>0</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Więcej</button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="#">Opcja1</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="avatar"><i class="fas fa-user"></i></span>
                            <a href="#">Thomas Jefferson</a>
                        </td>
                        <td>CC</td>
                        <td>online</td>
                        <td>0</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Więcej</button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="#">Opcja1</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>