@can('Rezervasiya tarixləri page - Əməliyyatlar - Bax - Yoxlamaya at')
    <div class="setReservationTime_modal_container" id="add-check-modal">
        <div class="setReservationTime_modal">
            <div class="modal-top">
                <h2>Yoxlamaya at</h2>
                <button class="closeSetReservationTime" type="button">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18M6 6L18 18" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <form action="" method="POST">
                @csrf
                <input type="hidden" name="container_ids[]">
                <div class="form-item">
                    <label for="">Səbəb</label>
                    <select name="container_check_reason_id" style="width: 100%" id="" class="nice-select">
                        <option value="">Seçin</option>
                        @foreach ($container_check_reasons as $container_check_reason)
                            <option value="{{ $container_check_reason->id }}">{{ $container_check_reason->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-note">
                    <label for="">Qeyd</label>
                    <textarea name="note" id=""></textarea>
                </div>
                <button class="setReservationTime_submit" type="submit">Təsdiq et</button>
            </form>
        </div>
    </div>
@endcan
