<?php

declare(strict_types=1);

use Controllers\TicketsController;

$ticketController = new TicketsController();

// Download ticketID from GET
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Download ticket data and messages
$ticketData = $ticketController->downloadTicketData($id);
$ticketMessages = $ticketController->downloadTicketMessages($id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Zgłoszenie #ID <?php echo $ticketData['id']; ?></h2>
    <br><br>

    <div class="d-flex flex-row align-items-center gap-4">
        <h5>Temat: <?php echo htmlspecialchars($ticketData['name']); ?></h5>
        <h5>Zgłoszone przez: <?php echo htmlspecialchars($ticketData['requester']); ?></h5>

        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Opcje
        </button>
        <div class="modal fade" tabindex="-1" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Opcje</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-floating">
                                <select name="status" class="form-select" id="floatingSelect-Status" aria-label="Floating label select example">
                                    <option selected>Otwarto</option>
                                    <option>W toku</option>
                                    <option>Zamknięte</option>
                                    <option>Do ponownej weryfikacji</option>
                                </select>
                                <label for="floatingSelect-Status">Zmień status zgłoszenia</label>
                            </div>
                            <div class="form-floating mt-5">
                                <select name="date" class="form-select" id="floatingSelect-Date" aria-label="Floating label select example">
                                    <option selected><?php echo date("Y-m-d"); ?></option>
                                </select>
                                <label for="floatingSelect-Date">Data</label>
                            </div>
                            <div class="form-floating mt-5">
                                <select name="realization-time" class="form-select" id="floatingSelect-Finish" aria-label="Floating label select example">
                                    <option>> 10min</option>
                                    <option selected>> 30min</option>
                                    <option>> 1h</option>
                                    <option>> 2h</option>
                                </select>
                                <label for="floatingSelect-Finish">Określ przewidywany czas realizacji</label>
                            </div>
                            <div class="form-floating mt-5">
                                <select name="operated-by" class="form-select" id="floatingSelect-FinishedBY" aria-label="Floating label select example">
                                    <option selected><?php echo $_SESSION["USER_DATA"]["username"] ?></option>
                                </select>
                                <label for="floatingSelect-FinishedBY">Obsługiwane przez</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-subtle" data-bs-dismiss="modal">Wstecz</button>
                            <button type="submitt" class="btn btn-primary">Zapisz</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <br><br>

    <div class="d-flex flex-column gap-5 bg-light" id="messagesContainer">
        <?php foreach ($ticketMessages as $row) : ?>
            <div class="card">
                <div class="card-header d-flex align-items-center ">
                    <span class="avatar text-bg-primary avatar-lg fs-5">R</span>
                    <div class="ms-3">
                        <h6 class="mb-0 fs-sm"><?php echo htmlspecialchars($row['username']); ?></h6>
                        <span class="text-muted fs-sm"><?php echo htmlspecialchars($row['created_at']); ?></span>
                    </div>
                    <button class="btn text-muted ms-auto" type="btn"><i class="fas fa-ellipsis-v"></i></button>
                </div>
                <div class="card-body">
                    <?php echo htmlspecialchars($row['message']); ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <br>

    <form method="post">
        <textarea class="form-control" id="textAreaExample" rows="3" placeholder="Add a message here" name="message"></textarea>

        <div class="input-group mt-2">
            <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
            <button class="btn btn-dark" type="submit" id="inputGroupFileAddon04">Wyślij</button>
        </div>
    </form>


    <script>
        async function fetchMessages() {
            try {
                const response = await fetch(`?route=ticket&id=<?php echo $id; ?>&ajax=1`);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const data = await response.json();
                if (data.error) {
                    console.error('Error fetching messages:', data.error);
                } else {
                    const messagesContainer = document.getElementById('messagesContainer');
                    messagesContainer.innerHTML = ''; // Clear current messages
                    data.forEach(row => {
                        const messageDiv = document.createElement('div');
                        messageDiv.classList.add('card');
                        messageDiv.innerHTML = `
                            <div class="card-header d-flex align-items-center">
                                <span class="avatar text-bg-primary avatar-lg fs-5">R</span>
                                <div class="ms-3">
                                    <h6 class="mb-0 fs-sm">${row.username}</h6>
                                    <span class="text-muted fs-sm">${row.created_at}</span>
                                </div>
                                <button class="btn text-muted ms-auto" type="btn"><i class="fas fa-ellipsis-v"></i></button>
                            </div>
                            <div class="card-body">
                                ${row.message}
                            </div>
                        `;
                        messagesContainer.appendChild(messageDiv);
                    });
                }
            } catch (error) {
                console.error('Error fetching messages:', error);
            }
        }

        // Odświeżaj wiadomości co 5 sekund
        setInterval(fetchMessages, 5000);
    </script>
</body>

</html>