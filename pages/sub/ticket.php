<?php

declare(strict_types=1);

use Controllers\TicketsController;

ob_start();

$ticketController = new TicketsController();

// Get ticket info
$id = (int)$_GET["id"];
$ticketData = $ticketController->downloadTicketData($id);

// Send message system
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["message"])) {
    if (!empty($_POST["message"])) {
        $data = [
            "ticket_id" => $id,
            "user_id" => $_SESSION["USER_DATA"]["id"],
            "message" => $_POST["message"],
            "username" => $_SESSION["USER_DATA"]["username"]
        ];
        $ticketController->sendMessageFromTicket($data);

        header("Location: /?route=ticket&id=$id");
        exit();
    }
}

// Download messages
$ticketMessages = $ticketController->downloadTicketMessages($id);

ob_end_flush();

// Can help for future errors 
// ob_end_clean();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Details</title>
</head>

<body>
    <h2>Zgłoszenie #ID <?php echo htmlspecialchars((string)$ticketData["id"], ENT_QUOTES); ?></h2>
    <br><br>

    <div class="d-flex flex-row align-items-center gap-4">
        <h5>Temat: <?php echo htmlspecialchars($ticketData["name"], ENT_QUOTES); ?></h5>
        <h5>Zgłoszone przez: <?php echo htmlspecialchars($ticketData["requester"], ENT_QUOTES); ?></h5>

        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Opcje
        </button>
        <div class="modal fade" tabindex="-1" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum pretium nisi nunc,
                        sit amet tincidunt ipsum faucibus vitae. Pellentesque eget odio tristique, mattis elit id.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-subtle" data-bs-dismiss="modal">Secondary Action</button>
                        <button type="button" class="btn btn-primary">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br><br>

    <div class="d-flex flex-column gap-5 bg-light">
        <?php foreach ($ticketMessages as $row) : ?>
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <span class="avatar text-bg-primary avatar-lg fs-5">R</span>
                    <div class="ms-3">
                        <h6 class="mb-0 fs-sm"><?php echo htmlspecialchars($row["username"], ENT_QUOTES); ?></h6>
                        <span class="text-muted fs-sm"><?php echo htmlspecialchars($row["created_at"], ENT_QUOTES); ?></span>
                    </div>
                    <button class="btn text-muted ms-auto" type="btn"><i class="fas fa-ellipsis-v"></i></button>
                </div>
                <div class="card-body">
                    <?php echo htmlspecialchars($row["message"], ENT_QUOTES); ?>
                </div>
            </div>
        <?php endforeach; ?>

        <br>

        <form method="post">
            <textarea class="form-control" id="textAreaExample" rows="3" placeholder="Add a message here" name="message"></textarea>
            <div class="input-group">
                <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                <button class="btn btn-dark" type="submit" id="inputGroupFileAddon04">Wyślij</button>
            </div>
        </form>
    </div>
</body>

</html>