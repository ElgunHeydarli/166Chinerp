<div class="chineReserved_modal_container" id="create-order-modal">
    <div class="chineReserved_modal" style="max-width: 900px;">
        <h2>Xəbərdarlıq</h2>
        <button class="closeChineReservedModal" onclick="close_create_order_modal()" type="button">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18 6L6 18M6 6L18 18" stroke="black" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>

        <div class="confirm-buttons">
            <h2 style="margin-bottom:20px;">Bu yükün çəkisi ölçülərinə nisbətdə çox böyükdür? Əlavə etmək
                istədiyinizə
                əminsiniz mi?</h2>
            <form action="" style="flex-direction:row; justify-content: center;">
                <button class="chinaReserved_submitBtn" onclick="submit_order()" type="button">Bəli</button>
                <button class="chinaReserved_submitBtn" onclick="close_create_order_modal()"
                    style="background: #fff;color: #00A3E8;border: 1px solid #00A3E8;" type="button">Xeyr</button>
            </form>
        </div>
    </div>
</div>
