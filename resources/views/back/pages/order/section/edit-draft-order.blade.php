<div class="edit_draftOrder_modal_container">
    <div class="edit_draftOrder_modal">
        <div class="modal-top">
            <h2>Düzəliş et</h2>
            <button class="closeEditOrderModal" type="button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6L6 18M6 6L18 18" stroke="black" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
        </div>
        <form method="POST">
            @csrf
            @method('PUT')
            <div class="form-item">
                <label for="">
                    {{ trns('price') }}
                </label>
                <input type="text" readonly name="price" placeholder="Text here...">
            </div>
            <div class="form-item">
                <label for="">
                    Qeyd
                </label>
                <input type="text" name="note" placeholder="Text here...">
            </div>
            <button class="edit_submitBtn" type="submit">Düzəliş et</button>
        </form>
    </div>
</div>
