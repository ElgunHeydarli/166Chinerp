<div class="chineReserved_modal_container" id="change-cbm">
    <div class="chineReserved_modal">
        <h2>Rezervasiya</h2>
        <button class="closeChineReservedModal" onclick="close_change_cbm_modal(this)" type="button">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18 6L6 18M6 6L18 18" stroke="black" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>
        <form action="" method="POST">
            @csrf
            <input type="hidden" name="order_item_id">
            <div class="form-items" style="display:flex; flex-wrap: wrap;">
            </div>

            <div class="confirm-buttons">
                <h2 style="margin-bottom:20px;">CBM dəyişdi?</h2>
                <button class="chinaReserved_submitBtn" onclick="change_cbm(this)"
                    data-action="{{ route('admin.order.change-cbm') }}" type="button">Bəli</button>
                <button class="chinaReserved_submitBtn" onclick="divide_order(this)" id="divide-order"
                    data-action="{{ route('admin.order.divide-order') }}"
                    style="background: #fff;color: #00A3E8;border: 1px solid #00A3E8;" type="button">Xeyr</button>
            </div>

            <div class="submit-buttons" style="display: none;">
                <button class="chinaReserved_submitBtn" id="confirm-button" type="submit">Təsdiq et</button>
                <button class="chinaReserved_submitBtn"
                    style="background: #fff;color: #00A3E8;border: 1px solid #00A3E8;" onclick="reverse_operation()" type="button">{{ trns('operations') }}ı geri al</button>
            </div>
        </form>
    </div>
</div>
