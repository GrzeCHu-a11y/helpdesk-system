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