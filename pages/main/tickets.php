<?php

use Controllers\DataController;
use Controllers\TicketsController;

$dataController = new DataController();
$ticketController = new TicketsController();

$tickets = $dataController->downloadTicketsData();
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
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="bi bi-plus-circle"></i>
            </button>
            <?php include 'htmlcomponents/modal_add_ticket.php'; ?>
            <?php include 'htmlcomponents/modal_filter_tickets.php'; ?>
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
                <?php if (!empty($tickets)) : ?>
                    <?php foreach ($tickets as $ticket) : ?>
                        <tr>
                            <th scope="row"><?php echo htmlspecialchars($ticket["id"]) ?></th>
                            <td><?php echo htmlspecialchars($ticket["name"]) ?></td>
                            <td><?php echo htmlspecialchars($ticket["requester"]) ?></td>
                            <td><?php echo htmlspecialchars($ticket["requested"]) ?></td>
                            <td><?php echo htmlspecialchars($ticket["type"]) ?></td>
                            <td><?php echo htmlspecialchars($ticket["status"]) ?></td>
                            <td><?php echo htmlspecialchars($ticket["operated_by"] ?? "") ?></td>
                            <td><?php echo htmlspecialchars($ticket["opened_at"] ?? "") ?></td>
                            <td><?php echo htmlspecialchars($ticket["realization_time"] ?? "") ?></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Więcej
                                    </button>
                                    <ul class="dropdown-menu">
                                        <form method="post">
                                            <li><a class="dropdown-item" href="/?route=ticket&id=<?php echo htmlspecialchars($ticket["id"]) ?>">Szczegóły</a></li>
                                            <li><button class="dropdown-item">Usuń</button></li>
                                            <input type="hidden" name="delete-ticket" value="<?php echo (int) $ticket["id"] ?>">
                                        </form>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="10" class="text-center">Brak zgłoszeń</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </section>
</body>

</html>