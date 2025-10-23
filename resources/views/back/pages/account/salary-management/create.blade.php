@extends('back.layouts.master')

@section('content')
    <div class="finance_tab_content">
        <a href="{{ route('admin.salary-management.index') }}" class="backLink">
            <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M9.80442 17.7083L18.0112 25.9136L16.9997 26.9166L7.08301 16.9999L16.9997 7.08325L18.0112 8.08625L9.80301 16.2916H26.9163V17.7083H9.80442Z"
                    fill="black" />
            </svg>
            Geri
        </a>
        <div class="tabContent-head">
            <form action="" class="table-search">
                <input type="text" placeholder="Axtar" />
                <button class="submitForm" type="submit">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="11.5" cy="11.5" r="9.5" stroke="#fff" stroke-width="1.5" />
                        <path d="M18.5 18.5L22 22" stroke="#fff" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </button>
            </form>
            <div class="timeItem">
                <select name="" id="" class="nice-select">
                    <option value="">Ay seçin</option>
                    <option value="">Yanvar</option>
                    <option value="">Fevral</option>
                    <option value="">Mart</option>
                    <option value="">Aprel</option>
                    <option value="">May</option>
                    <option value="">İyun</option>
                    <option value="">İyul</option>
                    <option value="">Avqust</option>
                    <option value="">Sentyabr</option>
                    <option value="">Oktyabr</option>
                    <option value="">Noyabr</option>
                    <option value="">Dekabr</option>
                </select>
            </div>
            <div class="timeItem">
                <select name="" id="ascsa" class="nice-select">
                    <option value="">İl seçin</option>
                    <option value="">2025</option>
                    <option value="">2026</option>
                    <option value="">2027</option>
                </select>
            </div>
        </div>
        <form action="{{ route('admin.salary-management.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="finance_tabContent_inner">
                <div class="addBulkPaymentTable">
                    <div class="addBulkPaymentTable-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>İşçi ID</th>
                                    <th>Ad</th>
                                    <th>Soyad</th>
                                    <th>Vəzifə</th>
                                    <th>Gross ə/h</th>
                                    <th>
                                        <div class="bulkTableHeadInput">
                                            <input type="checkbox" id="all_cash" onchange="select_all(this)" />
                                            <label for="all_cash">Nağd</label>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="bulkTableHeadInput">
                                            <input type="checkbox" id="all_bank" onchange="select_all(this)" />
                                            <label for="all_bank">Bank</label>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="bulkTableHeadInput">
                                            <input type="checkbox" id="all_government" onchange="select_all(this)" />
                                            <label for="all_government">Hökümət ödənişləri</label>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="bulkTableHeadInput">
                                            <input type="checkbox" id="all_withholding" onchange="select_all(this)" />
                                            <label for="all_withholding">Tutulmalar</label>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="bulkTableHeadInput">
                                            <input type="checkbox" id="all_bonus" onchange="select_all(this)" />
                                            <label for="all_bonus">Bonus</label>
                                        </div>
                                    </th>
                                    <th>Net ə/h</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>E-00{{ $user->id }}</td>
                                        <td>{{ $user->firstname }}</td>
                                        <td>{{ $user->lastname }}</td>
                                        <td>{{ $user->position }}</td>
                                        <td>{{ $user->gross_salary }}</td>
                                        <td>
                                            <div class="bulkTableBodyInput">
                                                <input type="checkbox" name="cash_value[{{ $user->id }}]"
                                                    onchange="calculate_total_price()" value="{{ $user->cash }}" />
                                                <input type="text" class="payment_value" oninput="change_price(this)"
                                                    value="{{ $user->cash }}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="bulkTableBodyInput">
                                                <input type="checkbox" name="bank_value[{{ $user->id }}]"
                                                    onchange="calculate_total_price()" value="{{ $user->bank }}" />
                                                <input type="text" class="payment_value" oninput="change_price(this)"
                                                    value="{{ $user->bank }}">

                                            </div>
                                        </td>
                                        <td>
                                            <div class="bulkTableBodyInput">
                                                <input type="checkbox" name="government_value[{{ $user->id }}]"
                                                    onchange="calculate_total_price()"
                                                    value="{{ $user->government_payment }}" />
                                                <input type="text" class="payment_value" oninput="change_price(this)"
                                                    value="{{ $user->government_payment }}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="bulkTableBodyInput">
                                                <input type="checkbox" name="withholding_value[{{ $user->id }}]"
                                                    onchange="calculate_total_price()"
                                                    value="{{ ($user->gross_salary ?? 0) - ($user->net_salary ?? 0) }}" />
                                                <input type="text" class="payment_value" oninput="change_price(this)">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="bulkTableBodyInput">
                                                <input type="checkbox" name="bonus_value[{{ $user->id }}]"
                                                    onchange="calculate_total_price()" value="" />
                                                <input type="text" class="payment_value" oninput="change_price(this)">
                                            </div>
                                        </td>
                                        <td>{{ $user->net_salary }}</td>
                                        <td>
                                            <input type="checkbox" onchange="select_all_type(this)"
                                                class="bulkRowInput" />
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="bulkFiles">
                <div class="bulk-file-item">
                    <label for="">Bank faylı əlavə et</label>
                    <div class="file-area">
                        <p>
                            Yüklə
                            <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.616 16.577H7.077C5.949 16.577 4.98767 16.1797 4.193 15.385C3.39833 14.5903 3.00067 13.6287 3 12.5C2.99933 11.3713 3.397 10.4097 4.193 9.615C4.989 8.82033 5.95033 8.42266 7.077 8.422H10.616V9.422H7.077C6.23033 9.422 5.506 9.72333 4.904 10.326C4.30133 10.9293 4 11.654 4 12.5C4 13.346 4.30133 14.0703 4.904 14.673C5.50667 15.2757 6.231 15.577 7.077 15.577H10.616V16.577ZM8.5 13V12H15.5V13H8.5ZM13.385 16.577V15.577H16.923C17.7697 15.577 18.494 15.2757 19.096 14.673C19.6987 14.0703 20 13.346 20 12.5C20 11.654 19.6987 10.9297 19.096 10.327C18.4933 9.72433 17.769 9.423 16.923 9.423H13.385V8.423H16.923C18.051 8.423 19.0127 8.82033 19.808 9.615C20.6033 10.4097 21.0007 11.3713 21 12.5C20.9993 13.6287 20.6017 14.5903 19.807 15.385C19.0123 16.1797 18.051 16.5773 16.923 16.578L13.385 16.577Z"
                                    fill="white" />
                            </svg>
                        </p>
                        <input type="file" name="bank_file" />
                        <span class="fileName"></span>
                    </div>
                </div>
                <div class="bulk-file-item">
                    <label for="">Nəğd faylı əlavə et</label>
                    <div class="file-area">
                        <p>
                            Yüklə
                            <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.616 16.577H7.077C5.949 16.577 4.98767 16.1797 4.193 15.385C3.39833 14.5903 3.00067 13.6287 3 12.5C2.99933 11.3713 3.397 10.4097 4.193 9.615C4.989 8.82033 5.95033 8.42266 7.077 8.422H10.616V9.422H7.077C6.23033 9.422 5.506 9.72333 4.904 10.326C4.30133 10.9293 4 11.654 4 12.5C4 13.346 4.30133 14.0703 4.904 14.673C5.50667 15.2757 6.231 15.577 7.077 15.577H10.616V16.577ZM8.5 13V12H15.5V13H8.5ZM13.385 16.577V15.577H16.923C17.7697 15.577 18.494 15.2757 19.096 14.673C19.6987 14.0703 20 13.346 20 12.5C20 11.654 19.6987 10.9297 19.096 10.327C18.4933 9.72433 17.769 9.423 16.923 9.423H13.385V8.423H16.923C18.051 8.423 19.0127 8.82033 19.808 9.615C20.6033 10.4097 21.0007 11.3713 21 12.5C20.9993 13.6287 20.6017 14.5903 19.807 15.385C19.0123 16.1797 18.051 16.5773 16.923 16.578L13.385 16.577Z"
                                    fill="white" />
                            </svg>
                        </p>
                        <input type="file" name="cash_file" />
                        <span class="fileName"></span>
                    </div>
                </div>
                <div class="bulk-file-item"
                    style="border: 1px solid rgba(236, 236, 238, 0.8);padding: 10px 18px;position: relative; border-radius: 4px;">
                    <input type="text" class="datetimepicker" value="{{ now()->format('d.m.Y') }}" required name="last_payment_date"
                        placeholder="Son ödəniş tarixi">
                    <div class="calendar-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M19.5 3.75H4.5C3.25736 3.75 2.25 4.75736 2.25 6V19.5C2.25 20.7426 3.25736 21.75 4.5 21.75H19.5C20.7426 21.75 21.75 20.7426 21.75 19.5V6C21.75 4.75736 20.7426 3.75 19.5 3.75Z"
                                stroke="#959595" stroke-linejoin="round"></path>
                            <path
                                d="M13.875 12C14.4963 12 15 11.4963 15 10.875C15 10.2537 14.4963 9.75 13.875 9.75C13.2537 9.75 12.75 10.2537 12.75 10.875C12.75 11.4963 13.2537 12 13.875 12Z"
                                fill="#959595"></path>
                            <path
                                d="M17.625 12C18.2463 12 18.75 11.4963 18.75 10.875C18.75 10.2537 18.2463 9.75 17.625 9.75C17.0037 9.75 16.5 10.2537 16.5 10.875C16.5 11.4963 17.0037 12 17.625 12Z"
                                fill="#959595"></path>
                            <path
                                d="M13.875 15.75C14.4963 15.75 15 15.2463 15 14.625C15 14.0037 14.4963 13.5 13.875 13.5C13.2537 13.5 12.75 14.0037 12.75 14.625C12.75 15.2463 13.2537 15.75 13.875 15.75Z"
                                fill="#959595"></path>
                            <path
                                d="M17.625 15.75C18.2463 15.75 18.75 15.2463 18.75 14.625C18.75 14.0037 18.2463 13.5 17.625 13.5C17.0037 13.5 16.5 14.0037 16.5 14.625C16.5 15.2463 17.0037 15.75 17.625 15.75Z"
                                fill="#959595"></path>
                            <path
                                d="M6.375 15.75C6.99632 15.75 7.5 15.2463 7.5 14.625C7.5 14.0037 6.99632 13.5 6.375 13.5C5.75368 13.5 5.25 14.0037 5.25 14.625C5.25 15.2463 5.75368 15.75 6.375 15.75Z"
                                fill="#959595"></path>
                            <path
                                d="M10.125 15.75C10.7463 15.75 11.25 15.2463 11.25 14.625C11.25 14.0037 10.7463 13.5 10.125 13.5C9.50368 13.5 9 14.0037 9 14.625C9 15.2463 9.50368 15.75 10.125 15.75Z"
                                fill="#959595"></path>
                            <path
                                d="M6.375 19.5C6.99632 19.5 7.5 18.9963 7.5 18.375C7.5 17.7537 6.99632 17.25 6.375 17.25C5.75368 17.25 5.25 17.7537 5.25 18.375C5.25 18.9963 5.75368 19.5 6.375 19.5Z"
                                fill="#959595"></path>
                            <path
                                d="M10.125 19.5C10.7463 19.5 11.25 18.9963 11.25 18.375C11.25 17.7537 10.7463 17.25 10.125 17.25C9.50368 17.25 9 17.7537 9 18.375C9 18.9963 9.50368 19.5 10.125 19.5Z"
                                fill="#959595"></path>
                            <path
                                d="M13.875 19.5C14.4963 19.5 15 18.9963 15 18.375C15 17.7537 14.4963 17.25 13.875 17.25C13.2537 17.25 12.75 17.7537 12.75 18.375C12.75 18.9963 13.2537 19.5 13.875 19.5Z"
                                fill="#959595"></path>
                            <path d="M6 2.25V3.75M18 2.25V3.75" stroke="#959595" stroke-linecap="round"
                                stroke-linejoin="round">
                            </path>
                            <path d="M21.75 7.5H2.25" stroke="#959595" stroke-linejoin="round"></path>
                        </svg>
                    </div>
                </div>
                <div class="bulk-file-item">
                    <select name="currency" id="" class="nice-select">
                        @foreach ($currencies as $currency)
                            <option value="{{ $currency->code }}">{{ $currency->code }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="totalPayment">
                    <p>Cəmi:</p>
                    <span>0</span>
                </div>
            </div>
            <button type="submit" class="addBulkPaymentSubmit">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.94513 4.25H13.0549C14.4225 4.24998 15.5248 4.24996 16.3918 4.36652C17.2919 4.48754 18.0497 4.74643 18.6517 5.34835C19.2061 5.90277 19.4695 6.58951 19.6022 7.39783C20.4106 7.53047 21.0974 7.79391 21.6519 8.3484C22.2538 8.95032 22.5127 9.70819 22.6337 10.6083C22.7503 11.4753 22.7503 12.5776 22.7503 13.9452V14.0549C22.7503 15.4225 22.7503 16.5248 22.6337 17.3918C22.5127 18.2919 22.2538 19.0498 21.6519 19.6517C21.05 20.2536 20.2921 20.5125 19.392 20.6335C18.525 20.7501 17.4227 20.7501 16.0551 20.7501H10.9454C9.57779 20.7501 8.47547 20.7501 7.6085 20.6335C6.7084 20.5125 5.95052 20.2536 5.3486 19.6517C4.79417 19.0973 4.53072 18.4105 4.39807 17.6022C3.58964 17.4695 2.90283 17.2061 2.34835 16.6517C1.74643 16.0497 1.48754 15.2919 1.36652 14.3918C1.24996 13.5248 1.24998 12.4225 1.25 11.0549V10.9451C1.24998 9.57754 1.24996 8.47522 1.36652 7.60825C1.48754 6.70814 1.74643 5.95027 2.34835 5.34835C2.95027 4.74643 3.70814 4.48754 4.60825 4.36652C5.47522 4.24996 6.57754 4.24998 7.94513 4.25ZM5.95571 17.7316C6.0606 18.1345 6.20999 18.3918 6.40926 18.591C6.68603 18.8678 7.0746 19.0483 7.80837 19.1469C8.56373 19.2485 9.56484 19.2501 11.0003 19.2501H16.0003C17.4357 19.2501 18.4368 19.2485 19.1921 19.1469C19.9259 19.0483 20.3145 18.8678 20.5912 18.591C20.868 18.3143 21.0485 17.9257 21.1471 17.1919C21.2487 16.4366 21.2503 15.4355 21.2503 14.0001C21.2503 12.5646 21.2487 11.5635 21.1471 10.8082C21.0485 10.0744 20.868 9.68583 20.5912 9.40906C20.3919 9.20976 20.1346 9.06034 19.7316 8.95545C19.75 9.54434 19.75 10.206 19.75 10.9451V11.0549C19.75 12.4225 19.75 13.5248 19.6335 14.3918C19.5125 15.2919 19.2536 16.0497 18.6517 16.6517C18.0497 17.2536 17.2919 17.5125 16.3918 17.6335C15.5248 17.75 14.4225 17.75 13.0549 17.75H7.94513C7.2061 17.75 6.54453 17.75 5.95571 17.7316ZM4.80812 5.85315C4.07435 5.9518 3.68577 6.13225 3.40901 6.40901C3.13225 6.68577 2.9518 7.07435 2.85315 7.80812C2.75159 8.56347 2.75 9.56459 2.75 11C2.75 12.4354 2.75159 13.4365 2.85315 14.1919C2.9518 14.9257 3.13225 15.3142 3.40901 15.591C3.68577 15.8678 4.07435 16.0482 4.80812 16.1469C5.56347 16.2484 6.56458 16.25 8 16.25H13C14.4354 16.25 15.4365 16.2484 16.1919 16.1469C16.9257 16.0482 17.3142 15.8678 17.591 15.591C17.8678 15.3142 18.0482 14.9257 18.1469 14.1919C18.2484 13.4365 18.25 12.4354 18.25 11C18.25 9.56459 18.2484 8.56347 18.1469 7.80812C18.0482 7.07435 17.8678 6.68577 17.591 6.40901C17.3142 6.13225 16.9257 5.9518 16.1919 5.85315C15.4365 5.75159 14.4354 5.75 13 5.75H8C6.56458 5.75 5.56347 5.75159 4.80812 5.85315ZM10.5 9.25C9.5335 9.25 8.75 10.0335 8.75 11C8.75 11.9665 9.5335 12.75 10.5 12.75C11.4665 12.75 12.25 11.9665 12.25 11C12.25 10.0335 11.4665 9.25 10.5 9.25ZM7.25 11C7.25 9.20508 8.70508 7.75 10.5 7.75C12.2949 7.75 13.75 9.20508 13.75 11C13.75 12.7949 12.2949 14.25 10.5 14.25C8.70508 14.25 7.25 12.7949 7.25 11ZM5 8.25C5.41421 8.25 5.75 8.58579 5.75 9V13C5.75 13.4142 5.41422 13.75 5 13.75C4.58579 13.75 4.25 13.4142 4.25 13L4.25 9C4.25 8.58579 4.58579 8.25 5 8.25ZM16 8.25C16.4142 8.25 16.75 8.58579 16.75 9V13C16.75 13.4142 16.4142 13.75 16 13.75C15.5858 13.75 15.25 13.4142 15.25 13V9C15.25 8.58579 15.5858 8.25 16 8.25Z"
                        fill="#fff"></path>
                </svg>
                Ödə
            </button>
        </form>
    </div>
@endsection

@push('css')
    <style>
        .finance_tab_content .finance_tabContent_inner .addBulkPaymentTable .addBulkPaymentTable-table table tbody tr td .bulkTableBodyInput .payment_value {
            width: 100%;
            padding: 10px 5px;
            outline: none;
            border: none;
            background: transparent;
        }

        .bulk-file-item input {
            width: 100%;
            background: transparent;
            border: none;
            outline: none;
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
            text-align: left;
            color: #000;
        }

        .bulk-file-item .calendar-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            width: 24px;
            height: 24px;
        }
    </style>
@endpush


@push('js')
    <script>
        function select_all(item) {
            let th = item.parentElement.parentElement;
            let index = Array.from(th.parentElement.children).indexOf(th);
            let trs = document.querySelectorAll('.addBulkPaymentTable-table tbody tr');
            let checked = item.checked;
            trs.forEach(tr => {
                tr.children[index].querySelector('[type="checkbox"]').checked = checked;
            });
            calculate_total_price();
        }

        function select_all_type(item) {
            let checked = item.checked;
            let checkboxes = item.parentElement.parentElement.querySelectorAll('[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = checked;
            });
            calculate_total_price();
        }

        function calculate_total_price() {
            let cashes = document.querySelectorAll('.bulkTableBodyInput [type="checkbox"]');
            let totalPayment = document.querySelector('.totalPayment span');
            let total_price = 0;

            cashes.forEach(cash => {
                if (cash.checked) total_price += +(cash.value ?? 0);
            });

            totalPayment.innerHTML = total_price;
        }
    </script>

    <script>
        function add_payroll() {
            let form_data = get_form_data();
            const fd = new FormData();

            for (const key in form_data) {
                if (Array.isArray(form_data[key])) {
                    form_data[key].forEach((value, index) => {
                        fd.append(`${key}[${index}]`, value);
                    });
                }
            }

            let bank_file = document.querySelector('[name="bank_file"]');
            let cash_file = document.querySelector('[name="cash_file"]');
            if (bank_file && bank_file.files.length > 0) {
                fd.append('bank_file', bank_file.files[0]);
            }

            if (cash_file && cash_file.files.length > 0) {
                fd.append('cash_file', cash_file.files[0]);
            }

            fd.append('last_payment_date', document.querySelector('[name="last_payment_date"]').value);

            fetch("{{ route('admin.salary-management.store') }}", {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: fd
                })
                .then(res => res.json())
                .then(data => {
                    console.log(data);
                })
        }


        function get_form_data() {
            let bonus_values = document.querySelectorAll('input[name^="bonus_value\\["]');
            let cash_values = document.querySelectorAll('input[name^="cash_value\\["]');
            let bank_values = document.querySelectorAll('input[name^="bank_value\\["]');
            let withholding_values = document.querySelectorAll('input[name^="withholding_value\\["]');
            let government_values = document.querySelectorAll('input[name^="government_value\\["]');
            let bonuses = [];
            let cashes = [];
            let banks = [];
            let withholdings = [];
            let governments = [];

            bonus_values.forEach(bonus_value => {
                if (bonus_value.previousElementSibling.checked) bonuses.push(bonus_value.value);
            });

            cash_values.forEach(cash_value => {
                if (cash_value.previousElementSibling.checked) cashes.push(cash_value.value);
            });

            bank_values.forEach(bank_value => {
                if (bank_value.previousElementSibling.checked) banks.push(bank_value.value);
            });

            withholding_values.forEach(withholding_value => {
                if (withholding_value.previousElementSibling.checked) withholdings.push(withholding_value.value);
            });

            government_values.forEach(government_value => {
                if (government_value.previousElementSibling.checked) governments.push(government_value.value);
            });

            return {
                'cash_value': cashes,
                'bank_value': banks,
                'goverment_value': governments,
                'withholding_value': withholdings,
                'bonus_value': bonuses,
            };
        }
    </script>

    <script>
        function change_price(item) {
            item.previousElementSibling.value = item.value;
            calculate_total_price();
        }
    </script>
@endpush
