<div class="viewCostPayModal_container">
    <div class="viewCostPayModal">
        <h2>Ödəniş əlavə et</h2>
        <button class="closeViewCostPayModal" onclick="close_pay_modal()" type="button">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18 6L6 18M6 6L18 18" stroke="black" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>
        <form action="{{ route('admin.expense.pay', $expense->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-line">
                <div class="form-item">
                    <label for=""> Tarix </label>
                    <input type="text" name="date" autocomplete="off" class="datetimepicker" />
                    <div class="calendar-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M19.5 3.75H4.5C3.25736 3.75 2.25 4.75736 2.25 6V19.5C2.25 20.7426 3.25736 21.75 4.5 21.75H19.5C20.7426 21.75 21.75 20.7426 21.75 19.5V6C21.75 4.75736 20.7426 3.75 19.5 3.75Z"
                                stroke="#959595" stroke-linejoin="round" />
                            <path
                                d="M13.875 12C14.4963 12 15 11.4963 15 10.875C15 10.2537 14.4963 9.75 13.875 9.75C13.2537 9.75 12.75 10.2537 12.75 10.875C12.75 11.4963 13.2537 12 13.875 12Z"
                                fill="#959595" />
                            <path
                                d="M17.625 12C18.2463 12 18.75 11.4963 18.75 10.875C18.75 10.2537 18.2463 9.75 17.625 9.75C17.0037 9.75 16.5 10.2537 16.5 10.875C16.5 11.4963 17.0037 12 17.625 12Z"
                                fill="#959595" />
                            <path
                                d="M13.875 15.75C14.4963 15.75 15 15.2463 15 14.625C15 14.0037 14.4963 13.5 13.875 13.5C13.2537 13.5 12.75 14.0037 12.75 14.625C12.75 15.2463 13.2537 15.75 13.875 15.75Z"
                                fill="#959595" />
                            <path
                                d="M17.625 15.75C18.2463 15.75 18.75 15.2463 18.75 14.625C18.75 14.0037 18.2463 13.5 17.625 13.5C17.0037 13.5 16.5 14.0037 16.5 14.625C16.5 15.2463 17.0037 15.75 17.625 15.75Z"
                                fill="#959595" />
                            <path
                                d="M6.375 15.75C6.99632 15.75 7.5 15.2463 7.5 14.625C7.5 14.0037 6.99632 13.5 6.375 13.5C5.75368 13.5 5.25 14.0037 5.25 14.625C5.25 15.2463 5.75368 15.75 6.375 15.75Z"
                                fill="#959595" />
                            <path
                                d="M10.125 15.75C10.7463 15.75 11.25 15.2463 11.25 14.625C11.25 14.0037 10.7463 13.5 10.125 13.5C9.50368 13.5 9 14.0037 9 14.625C9 15.2463 9.50368 15.75 10.125 15.75Z"
                                fill="#959595" />
                            <path
                                d="M6.375 19.5C6.99632 19.5 7.5 18.9963 7.5 18.375C7.5 17.7537 6.99632 17.25 6.375 17.25C5.75368 17.25 5.25 17.7537 5.25 18.375C5.25 18.9963 5.75368 19.5 6.375 19.5Z"
                                fill="#959595" />
                            <path
                                d="M10.125 19.5C10.7463 19.5 11.25 18.9963 11.25 18.375C11.25 17.7537 10.7463 17.25 10.125 17.25C9.50368 17.25 9 17.7537 9 18.375C9 18.9963 9.50368 19.5 10.125 19.5Z"
                                fill="#959595" />
                            <path
                                d="M13.875 19.5C14.4963 19.5 15 18.9963 15 18.375C15 17.7537 14.4963 17.25 13.875 17.25C13.2537 17.25 12.75 17.7537 12.75 18.375C12.75 18.9963 13.2537 19.5 13.875 19.5Z"
                                fill="#959595" />
                            <path d="M6 2.25V3.75M18 2.25V3.75" stroke="#959595" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M21.75 7.5H2.25" stroke="#959595" stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
                <div class="form-item">
                    <label for=""> Valyuta </label>
                    <select name="currency" id="" class="nice-select">
                        @foreach ($currencies as $currency)
                            <option value="{{ $currency->code }}">{{ $currency->code }}</option>
                        @endforeach
                    </select>
                    <button class="resetSelectBtn" type="button">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.4 16.308L12 12.708L15.6 16.308L16.308 15.6L12.708 12L16.308 8.4L15.6 7.692L12 11.292L8.4 7.692L7.692 8.4L11.292 12L7.692 15.6L8.4 16.308ZM12.003 21C10.759 21 9.589 20.764 8.493 20.292C7.39767 19.8193 6.44467 19.178 5.634 18.368C4.82333 17.558 4.18167 16.606 3.709 15.512C3.23633 14.418 3 13.2483 3 12.003C3 10.7577 3.23633 9.58767 3.709 8.493C4.181 7.39767 4.82133 6.44467 5.63 5.634C6.43867 4.82333 7.391 4.18167 8.487 3.709C9.583 3.23633 10.753 3 11.997 3C13.241 3 14.411 3.23633 15.507 3.709C16.6023 4.181 17.5553 4.82167 18.366 5.631C19.1767 6.44033 19.8183 7.39267 20.291 8.488C20.7637 9.58333 21 10.753 21 11.997C21 13.241 20.764 14.411 20.292 15.507C19.82 16.603 19.1787 17.556 18.368 18.366C17.5573 19.176 16.6053 19.8177 15.512 20.291C14.4187 20.7643 13.249 21.0007 12.003 21ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                fill="#FF0000" />
                        </svg>
                    </button>
                </div>
                <div class="form-item">
                    <label for=""> Məbləğ </label>
                    <input type="text" oninput="convert_numeric(this)" name="amount" placeholder="Text here..." />
                </div>
                <div class="form-item">
                    <label for=""> Ödəniş üsulu </label>
                    <select name="payment_method" id="" class="nice-select">
                        <option value="{{ \App\Enums\PaymentMethod::BANK }}">Bank</option>
                        <option value="{{ \App\Enums\PaymentMethod::CASH }}">Nəğd</option>
                    </select>
                    <button class="resetSelectBtn" type="button">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.4 16.308L12 12.708L15.6 16.308L16.308 15.6L12.708 12L16.308 8.4L15.6 7.692L12 11.292L8.4 7.692L7.692 8.4L11.292 12L7.692 15.6L8.4 16.308ZM12.003 21C10.759 21 9.589 20.764 8.493 20.292C7.39767 19.8193 6.44467 19.178 5.634 18.368C4.82333 17.558 4.18167 16.606 3.709 15.512C3.23633 14.418 3 13.2483 3 12.003C3 10.7577 3.23633 9.58767 3.709 8.493C4.181 7.39767 4.82133 6.44467 5.63 5.634C6.43867 4.82333 7.391 4.18167 8.487 3.709C9.583 3.23633 10.753 3 11.997 3C13.241 3 14.411 3.23633 15.507 3.709C16.6023 4.181 17.5553 4.82167 18.366 5.631C19.1767 6.44033 19.8183 7.39267 20.291 8.488C20.7637 9.58333 21 10.753 21 11.997C21 13.241 20.764 14.411 20.292 15.507C19.82 16.603 19.1787 17.556 18.368 18.366C17.5573 19.176 16.6053 19.8177 15.512 20.291C14.4187 20.7643 13.249 21.0007 12.003 21ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                fill="#FF0000" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="addCostFile">
                <div class="icon">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M32 32L24 24L16 32" stroke="#00A3E8" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M24 24V42" stroke="#00A3E8" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M40.7809 36.78C42.7316 35.7165 44.2726 34.0337 45.1606 31.9972C46.0487 29.9607 46.2333 27.6864 45.6853 25.5334C45.1373 23.3803 43.8879 21.471 42.1342 20.1069C40.3806 18.7427 38.2226 18.0014 36.0009 18H33.4809C32.8755 15.6585 31.7472 13.4846 30.1808 11.642C28.6144 9.79927 26.6506 8.33567 24.4371 7.36118C22.2236 6.3867 19.818 5.92669 17.4011 6.01573C14.9843 6.10478 12.619 6.74057 10.4833 7.8753C8.34747 9.01003 6.49672 10.6142 5.07014 12.5671C3.64356 14.5201 2.67828 16.771 2.24686 19.1508C1.81544 21.5305 1.92911 23.977 2.57932 26.3065C3.22954 28.636 4.39938 30.7877 6.0009 32.6"
                            stroke="#00A3E8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M32 32L24 24L16 32" stroke="#00A3E8" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="addCostFile-body">
                    <p>Select a file or drag and drop here</p>
                    <span>JPG, XLSX or PDF, file size no more than 10MB</span>
                </div>
                <div class="selectFile">Select file</div>
                <input type="file" name="file" />
            </div>
            <div class="addCostFile-fileUpload-area">
                <img src="{{ asset('back/assets') }}/images/pdfImg.svg" alt="" />
                <div class="addCostFile-fileUpload-main">
                    <div class="addCostFile-fileUpload-top">
                        <span class="addCostFile-FileName"></span>
                        <p class="addCostFile-fileSize"></p>
                    </div>
                    <div class="addCostFile-fileProgress">
                        <div class="uploadLine"></div>
                    </div>
                </div>
                <button class="removeAddCostFile" type="button">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.5 4.5L4.5 13.5M4.5 4.5L13.5 13.5" stroke="#FF0000" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>

            <button class="save_addCostPay" type="submit">Save</button>
        </form>
    </div>
</div>
