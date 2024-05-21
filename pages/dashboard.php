<?php

declare(strict_types=1);

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
        <h2>Panel</h2><span><?php echo $_SESSION["username"] ?></span>
        <br> <br>
        <!-- <div class="flex-row-container"></div> -->









        <div class="parent">

            <div class="card" id="div1">
                <div class="card-body">
                    <h6>Aktywne Tickety</h6>
                    <p>344</p>
                </div>
            </div>



            <div class="card" id="div2">
                <div class="card-body">
                    <h6>Rozwiązane Tickety Przez Grupe</h6>
                    <p>34</p>
                </div>
            </div>


            <div class="card" id="div3">
                <div class="card-body">
                    <h6>Tickety Rozwiązane Przeze Mnie</h6>
                    <p>12</p>
                </div>
            </div>

            <ol class="list-group list-group-numbered" id="div4">
                <h6>Ostatnia aktywność</h6>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div>Subheading</div>
                        <p class="mb-0 fs-sm text-muted">Content for list item</p>
                    </div>
                    <span class="badge text-bg-primary">14</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div>Subheading</div>
                        <p class="mb-0 fs-sm text-muted">Content for list item</p>
                    </div>
                    <span class="badge text-bg-primary">14</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div>Subheading</div>
                        <p class="mb-0 fs-sm text-muted">Content for list item</p>
                    </div>
                    <span class="badge text-bg-primary">14</span>
                </li>

            </ol>
            <ul class="list-group" id="div5">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img class="avatar avatar-lg" src="/images/avatar/1.jpg" alt="" />
                        <div class="ms-3">
                            <p class="fw-bold mb-0">John Doe</p>
                            <p class="text-muted mb-0 fs-sm">john.doe@gmail.com</p>
                        </div>
                    </div>
                    <span class="badge text-bg-success">Active</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img class="avatar avatar-lg" src="/images/avatar/2.jpg" alt="" />
                        <div class="ms-3">
                            <p class="fw-bold mb-0">Alex Ray</p>
                            <p class="text-muted mb-0 fs-sm">alex.ray@gmail.com</p>
                        </div>
                    </div>
                    <span class="badge text-bg-danger">Removed</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img class="avatar avatar-lg" src="/images/avatar/3.jpg" alt="" />
                        <div class="ms-3">
                            <p class="fw-bold mb-0">Kate Hunington</p>
                            <p class="text-muted mb-0 fs-sm">kate.hunington@gmail.com</p>
                        </div>
                    </div>
                    <span class="badge text-bg-warning">Awaiting</span>
                </li>
            </ul>
        </div>

    </section>
</body>

</html>