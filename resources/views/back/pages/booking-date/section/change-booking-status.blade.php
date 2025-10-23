<div class="editReservateDate_modal_container">
    <div class="editReservateDate_modal">
        <div class="modal-top">
            <h2>Statusu dəyiş</h2>
            <button class="closeEditReservateDate" type="button">
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
                    Status
                </label>
                <select name="status_id" id="" class="nice-select">
                    <option value="">Seçin</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                    @endforeach
                </select>
                <button class="resetSelectBtn" type="button">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.4 16.308L12 12.708L15.6 16.308L16.308 15.6L12.708 12L16.308 8.4L15.6 7.692L12 11.292L8.4 7.692L7.692 8.4L11.292 12L7.692 15.6L8.4 16.308ZM12.003 21C10.759 21 9.589 20.764 8.493 20.292C7.39767 19.8193 6.44467 19.178 5.634 18.368C4.82333 17.558 4.18167 16.606 3.709 15.512C3.23633 14.418 3 13.2483 3 12.003C3 10.7577 3.23633 9.58767 3.709 8.493C4.181 7.39767 4.82133 6.44467 5.63 5.634C6.43867 4.82333 7.391 4.18167 8.487 3.709C9.583 3.23633 10.753 3 11.997 3C13.241 3 14.411 3.23633 15.507 3.709C16.6023 4.181 17.5553 4.82167 18.366 5.631C19.1767 6.44033 19.8183 7.39267 20.291 8.488C20.7637 9.58333 21 10.753 21 11.997C21 13.241 20.764 14.411 20.292 15.507C19.82 16.603 19.1787 17.556 18.368 18.366C17.5573 19.176 16.6053 19.8177 15.512 20.291C14.4187 20.7643 13.249 21.0007 12.003 21ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                            fill="#959595" />
                    </svg>
                </button>
            </div>
            <button class="editReservateDate_submit" onclick="change_status()" type="submit">Təsdiq et</button>
        </form>
        <div class="editReservateDate-body">
            <div class="orderCode">
                <p>Sifariş:</p>
                <span>#JNSDCJDE</span>
            </div>
            <div class="order-details">
                <div class="approxDeliveyDate">
                    <p>Təxmini çatdırılma tarixi:</p>
                    <span>01.02.2025</span>
                </div>
                <div class="usps">
                    <p>USPS</p>
                    <span>14354621434686986</span>
                </div>
            </div>
        </div>
        <div class="status_levels">
            @foreach ($statuses as $status)
                <div class="level-item active">
                    <div class="item-main">
                        <div class="icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 12L10 17L20 7" stroke="white" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="itemDesc">
                            <p>{{ $status->name }}</p>
                            <span>{{ now()->format('d.m.Y') }}</span>
                        </div>
                    </div>
                    @if (!$loop->last)
                        <div class="item-line"></div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
