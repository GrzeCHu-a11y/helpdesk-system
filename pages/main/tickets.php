<?php

use Controllers\DataController;
use Controllers\TicketsController;

$dataController = new DataController();
$ticketController = new TicketsController();

$tickets = $dataController->downloadTicketsData();

if (isset($_POST["add"])) {
    echo "add ticket";
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
        <h2>Zgłoszenia</h2>
        <br><br>

        <form class="d-flex gap-2" method="post">
            <input class="form-control me-2" type="search" placeholder="Wyszukaj..." aria-label="Search">
            <button class="btn btn-subtle bg-dark" type="submit">
                <i class="bi bi-search text-light"></i>
            </button>
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <i class="bi bi-gear"></i>
            </button>

            <!-- modal for add ticket -->
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="bi bi-plus-circle"></i>
            </button>
            <div class="modal fade" tabindex="-1" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Dodaj nowe zgłoszenie</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex flex-wrap gap-5">
                                <input type="text" class="form-control flex-grow-1" placeholder="ID - AUTO" aria-label="ID" aria-describedby="basic-addon1" disabled />
                                <input name="subject-addTicket" type="text" class="form-control flex-grow-1" placeholder="Temat" aria-label="Temat" aria-describedby="basic-addon1" />
                                <label for="date">Wybierz datę</label>
                                <input name="date-addTicket" class="form-control flex-grow-1" type="date" id="date">

                                <label for="user">Zgłaszający</label>
                                <input name="user-addTicket" class="form-control flex-grow-1" type="text" id="user" readonly value="<?php echo $_SESSION["USER_DATA"]["username"] ?>">
                                <div class="form-floating">
                                    <select name="status-addTicket" class="form-select" id="floatingSelect-Status" aria-label="Floating label select example">
                                        <option selected>Otwarto</option>
                                        <option>W toku</option>
                                        <option>Zamknięte</option>
                                        <option>Do ponownej weryfikacji</option>
                                    </select>
                                    <label for="floatingSelect-Status">Poadaj status zgłoszenia</label>
                                </div>
                                <div class="form-floating">
                                    <select name="type-addTicket" class="form-select" id="floatingSelect-Type" aria-label="Floating label select example">
                                        <option selected>INNE</option>
                                        <option>INTERNET</option>
                                        <option>SPRZĘT</option>
                                    </select>
                                    <label for="floatingSelect-Type">Podaj typ zgłoszenia</label>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-subtle" data-bs-dismiss="modal">Wstecz</button>
                            <button type="submit" class="btn btn-primary">Zapisz</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal for add ticket -->

            <!-- modal for filtering tickets -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Filtruj wyniki</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <label for="TicketStatus">Status zgłoszenia</label>
                            <select class="form-select" aria-label="Default select example" id="ticketStatus">
                                <option selected>Wszystkie</option>
                                <option value="1">Aktywne</option>
                                <option value="2">Zakończone</option>
                                <option value="3">Usunięte</option>
                            </select>

                            <label class="mt-2" for="inlineFormInputGroupUsername">Nazwa zgłaszającego</label>
                            <div class="input-group">
                                <div class="input-group-text">@</div>
                                <input type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="Imię">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-subtle" data-bs-dismiss="modal">Zamknij</button>
                            <button type="button" class="btn btn-primary">Zapisz</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal for filtering tickets -->
        </form>
        <br><br>

        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Temat</th>
                    <th scope="col">Zgłaszający</th>
                    <th scope="col">Zgłoszono</th>
                    <th scope="col">Typ</th>
                    <th scope="col">Status</th>
                    <th scope="col">Obsługiwane przez</th>
                    <th scope="col">Otwarto w dniu</th>
                    <th scope="col">Przewidywany czas realizacji</th>
                    <th scope="col">Opcje</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tickets as $ticket) : ?>
                    <tr>
                        <th scope="row"><?php echo  $ticket["id"] ?></th>
                        <td><?php echo $ticket["name"] ?></td>
                        <td><?php echo $ticket["requester"] ?></td>
                        <td><?php echo $ticket["requested"] ?></td>
                        <td><?php echo $ticket["type"] ?></td>
                        <td><?php echo $ticket["status"] ?></td>
                        <td><?php echo $ticket["operated_by"] ?></td>
                        <td><?php echo $ticket["opened_at"] ?></td>
                        <td><?php echo $ticket["realization_time"] ?></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Więcej
                                </button>
                                <ul class="dropdown-menu">
                                    <form method="post">
                                        <li><a class="dropdown-item" href="/?route=ticket&id=<?php echo $ticket["id"] ?>">Szczegóły</a></li>
                                        <li><button class="dropdown-item">Usuń</button></li>
                                        <input type="hidden" name="delete-ticket" value="<?php echo (int) $ticket["id"] ?>">
                                    </form>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</body>

</html>