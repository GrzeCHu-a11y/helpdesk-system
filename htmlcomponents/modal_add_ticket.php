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
                    <input name="user-addTicket" class="form-control flex-grow-1" type="text" id="user" readonly value="<?php echo htmlspecialchars($_SESSION["USER_DATA"]["username"]) ?>">
                    <div class="form-floating">
                        <select name="status-addTicket" class="form-select" id="floatingSelect-Status" aria-label="Floating label select example">
                            <option selected>Nowo dodane</option>
                            <option>Otwarto</option>
                            <option>W toku</option>
                            <option>Zamknięte</option>
                            <option>Do ponownej weryfikacji</option>
                        </select>
                        <label for="floatingSelect-Status">Podaj status zgłoszenia</label>
                    </div>
                    <div class="form-floating">
                        <select name="type-addTicket" class="form-select" id="floatingSelect-Type" aria-label="Floating label select example">
                            <option selected>INNE</option>
                            <option>INTERNET</option>
                            <option>SPRZĘT</option>
                            <option>APLIKACJA</option>
                            <option>BEZPIECZEŃSTWO</option>
                            <option>UŻYTKOWNIK</option>
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