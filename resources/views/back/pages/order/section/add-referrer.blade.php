<div class="addCustomer_modal_container">
    <div class="addCustomer_modal">
        <div class="modal-top">
            <h2>{{ trns('add_referrer') }}</h2>
            <button class="closeAddCustomer" type="button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6L6 18M6 6L18 18" stroke="black" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
        </div>
        <form>
            <div class="form-item">
                <label for="">{{ trns('firstname') }}<span>*</span></label>
                <input type="text" name="firstname" placeholder="Text here...">
            </div>
            <div class="form-item">
                <label for="">{{ trns('lastname') }}</label>
                <input type="text" name="lastname" placeholder="Text here...">
            </div>
            <div class="form-item">
                <label for="">{{ trns('email') }}</label>
                <input type="text" name="email" placeholder="Text here...">
            </div>
            <button class="addCustomer_submitBtn" onclick="add_referrer()" type="submit">{{ trns('submit') }}</button>
        </form>
    </div>
</div>
