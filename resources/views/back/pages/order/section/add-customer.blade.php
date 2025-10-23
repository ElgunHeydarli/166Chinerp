<div class="addCustomer_modal_container">
    <div class="addCustomer_modal">
        <div class="modal-top">
            <h2>{{ trns('add_customer') }}</h2>
            <button class="closeAddCustomer" type="button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6L6 18M6 6L18 18" stroke="black" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
        </div>
        <form>
            <div class="form-item">
                <label for="">{{ trns('customer_type') }}<span>*</span></label>
                <select name="type" disabled class="nice-select" onchange="get_customer_type(this)" id="">
                    <option value="physical">{{ trns('physical') }}</option>
                    <option value="legal">{{ trns('legal') }}</option>
                </select>
            </div>
            <div class="form-item">
                <label for="">{{ trns('fullname') }}<span>*</span></label>
                <input type="text" name="customer_name" placeholder="Text here...">
            </div>
            <div class="form-item" id="voen">
                <label for="">{{ trns('voen') }}</label>
                <input type="text" name="voen" placeholder="Text here...">
            </div>
            <div class="form-item" id="fin">
                <label for="">{{ trns('fin') }}</label>
                <input type="text" name="fin" placeholder="Text here...">
            </div>
            <div class="form-item">
                <label for="">{{ trns('phone') }}</label>
                <input type="text" name="customer_phone" placeholder="+994 50 0000000">
            </div>
            <button class="addCustomer_submitBtn" onclick="add_customer()" type="submit">{{ trns('submit') }}</button>
        </form>
    </div>
</div>
