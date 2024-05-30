<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Zgłoszenie #ID 9182</h2>
    <br><br>

    <div class="d-flex flex-row align-items-center gap-4">
        <h5>Temat: Brak Połączenia z internetem /</h5>
        <h5>Użytkownik: Maciej Musiał - Media Expert</h5>

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

        <div class="card">
            <div class="card-header d-flex align-items-center ">
                <span class="avatar text-bg-primary avatar-lg fs-5">R</span>
                <div class="ms-3">
                    <h6 class="mb-0 fs-sm">Special title treatment</h6>
                    <span class="text-muted fs-sm">September 14, 2022</span>
                </div>
                <button class="btn text-muted ms-auto" type="btn"><i class="fas fa-ellipsis-v"></i></button>
            </div>
            <div class="card-body">
                With supporting text below as a natural lead-in to additional content.
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex align-items-center ">
                <span class="avatar text-bg-primary avatar-lg fs-5">R</span>
                <div class="ms-3">
                    <h6 class="mb-0 fs-sm">Special title treatment</h6>
                    <span class="text-muted fs-sm">September 14, 2022</span>
                </div>
                <button class="btn text-muted ms-auto" type="btn"><i class="fas fa-ellipsis-v"></i></button>
            </div>
            <div class="card-body">
                With supporting text below as a natural lead-in to additional content.
            </div>
        </div>

        <br>

        <textarea class="form-control" id="textAreaExample" rows="3" placeholder="Add a message here"></textarea>

        <div class="input-group">
            <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
            <button class="btn btn-dark" type="button" id="inputGroupFileAddon04">Wyślij</button>
        </div>

    </div>



</body>

</html>