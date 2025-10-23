<div class="reject_reservationPrice_modal_container">
    <div class="reject_reservationPrice_modal">
        <div class="modal-top">
            <h2>Düzəliş et</h2>
            <button class="closeReservationPriceModal" type="button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6L6 18M6 6L18 18" stroke="black" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
        </div>
        <form action="" method="POST">
            @csrf
            <div class="form-item">
                <label for="">
                    Konteyner növü
                </label>
                {{-- <input type="text" placeholder="Text here..."> --}}
                <select class="nice-select" disabled name="container_type_id" style="width: 100%;" id="">
                    <option value="">Seçin</option>
                    @foreach ($container_types as $container_type)
                        <option value="{{ $container_type->id }}">
                            {{ $container_type->name . ' (' . $container_type->max_size . ')' }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-item">
                <label for="">
                    Stansiya
                </label>
                {{-- <input type="text" placeholder="Text here..."> --}}
                <select class="nice-select" disabled name="station_id" style="width: 100%;" id="">
                    <option value="">Seçin</option>
                    @foreach ($stations as $station)
                        <option value="{{ $station->id }}">
                            {{ $station->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-item">
                <label for="">
                    Qiymət
                </label>
                <input type="text" name="price" placeholder="Text here...">
            </div>
            <button class="save_submitBtn" onclick="submit_container_price(this)" type="submit">Yadda saxla</button>
        </form>
    </div>
</div>
