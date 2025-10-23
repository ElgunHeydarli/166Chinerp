<div class="chineReserved_modal_container" id="combine-order">
    <div class="chineReserved_modal">
        <h2>Rezervasiya</h2>
        <button class="closeChineReservedModal" onclick="close_combine_order_modal()" type="button">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18 6L6 18M6 6L18 18" stroke="black" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>
        <form action="" method="POST">
            @csrf

            <div class="confirm-buttons">
                <h2 style="margin-bottom:20px;">Yük birləşdirilsin? </h2>
                <button class="chinaReserved_submitBtn" type="submit">Bəli</button>
                <button class="chinaReserved_submitBtn" onclick="close_combine_order_modal()"
                    style="background: #fff;color: #00A3E8;border: 1px solid #00A3E8;" type="button">Xeyr</button>
            </div>
        </form>
    </div>
</div>
