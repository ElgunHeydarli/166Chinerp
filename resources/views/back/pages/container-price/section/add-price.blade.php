<div class="add_reservationPrice_modal_container">
    <div class="add_reservationPrice_modal">
        <div class="modal-top">
            <h2>Əlavə et</h2>
            <button class="closeAddReservationPriceModal" type="button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6L6 18M6 6L18 18" stroke="black" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
        </div>
        <form action="{{ route('admin.container-price.store') }}" method="POST">
            @csrf
            <div class="form-item">
                <label for="">
                    Konteyner növü
                </label>
                <select name="container_type_id" id="" class="nice-select">
                    <option value="">Seçin</option>
                    @foreach ($container_types as $container_type)
                        <option value="{{ $container_type->id }}">
                            {{ $container_type->name . ' (' . $container_type->max_size . ')' }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-item">
                <label for="">
                    Stansiya növü
                </label>
                <select name="station_id" id="" class="nice-select">
                    <option value="">Seçin</option>
                    @foreach ($stations as $station)
                        <option value="{{ $station->id }}">{{ $station->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-item">
                <label for="">
                    Qiymət
                </label>
                <input type="text" name="price" placeholder="Text here...">
            </div>
            <button class="save_AddBtn" type="submit">Təsdiq et</button>
        </form>
    </div>
</div>
