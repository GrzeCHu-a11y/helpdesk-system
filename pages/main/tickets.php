<?php

use Controllers\DataController;
use Controllers\TicketsController;

$dataController = new DataController;
$ticketController = new TicketsController();

$tickets = $dataController->downloadTickets();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ticketId = $_POST["delete-ticket"];
    $ticketController->deleteTicket($ticketId);
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

        <form class="d-flex gap-2" role="search">
            <input class="form-control me-2" type="search" placeholder="Wyszukaj..." aria-label="Search">
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <i class="bi bi-gear"></i>
            </button>
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
            <button class="btn btn-subtle bg-dark" type="submit">
                <i class="bi bi-search text-light"></i>
            </button>
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