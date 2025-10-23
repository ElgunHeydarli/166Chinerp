@extends('back.layouts.master')

@section('content')
    <div class="orders_tab_content">
        <a href="{{ route('admin.order.create') }}" class="containerOrderLink" type="button">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18 12H12M12 12H6M12 12V6M12 12V18" stroke="white" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round"></path>
            </svg>
            {{ trns('create_draft_order') }}
        </a>
        <div class="tabContent-head">
            <div class="filterColumns">
                <select onchange="filter()" id="limit" class="nice-select">
                    <option value="10" {{ request('limit', 10) == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('limit', 10) == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('limit', 10) == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('limit', 10) == 100 ? 'selected' : '' }}>100</option>
                </select>
            </div>
            <div class="filterColumns">
                <select onchange="filter()" id="sort_by" class="nice-select">
                    <option value="">{{ trns('sort_by') }}</option>
                    <option value="name_asc">A-Z</option>
                    <option value="name_desc">Z-A</option>
                    <option value="old_to_new">{{ trns('old_to_new') }}</option>
                    <option value="new_to_old">{{ trns('new_to_old') }}</option>
                    <option value="apply_date">{{ trns('for_apply_date') }}</option>
                    @if (request('status') == 'execute')
                        <option value="booking_date">Rezervasiya tarixinə görə</option>
                    @endif
                </select>
            </div>
            <div class="filterColumns">
                <input type="text" class="datetimepicker" value="{{ request('start_date') }}" onchange="filter()"
                    id="start_date" placeholder="{{ trns('start_time') }}">
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
                        <path d="M6 2.25V3.75M18 2.25V3.75" stroke="#959595" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                        <path d="M21.75 7.5H2.25" stroke="#959595" stroke-linejoin="round"></path>
                    </svg>
                </div>
            </div>
            <div class="filterColumns">
                <input type="text" class="datetimepicker" value="{{ request('end_date') }}" onchange="filter()"
                    id="end_date" placeholder="{{ trns('end_time') }}">
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
                        <path d="M6 2.25V3.75M18 2.25V3.75" stroke="#959595" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                        <path d="M21.75 7.5H2.25" stroke="#959595" stroke-linejoin="round"></path>
                    </svg>
                </div>
            </div>
            <div class="filterColumns">
                <select onchange="filter()" id="type" class="nice-select">
                    <option value="">{{ trns('cargo_type') }}</option>
                    <option value="mix" {{ request('type') == 'mix' ? 'selected' : '' }}>{{ trns('mix') }}</option>
                    <option value="full" {{ request('type') == 'full' ? 'selected' : '' }}>{{ trns('full') }}</option>
                    <option value="automobile" {{ request('type') == 'automobile' ? 'selected' : '' }}>
                        {{ trns('automobile') }}</option>
                </select>
            </div>
            <form action="" class="table-search">
                <input type="text" name="search" id="search" oninput="filter()" value="{{ request('search') }}"
                    placeholder="{{ trns('search') }}">
                <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                <input type="hidden" name="status" value="{{ request('status') }}">
                <input type="hidden" name="type" value="{{ request('type') }}">
                <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
                <input type="hidden" name="limit" value="{{ request('limit') }}">
                <button class="submitForm" type="submit">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="11.5" cy="11.5" r="9.5" stroke="#fff" stroke-width="1.5"></circle>
                        <path d="M18.5 18.5L22 22" stroke="#fff" stroke-width="1.5" stroke-linecap="round"></path>
                    </svg>
                </button>
            </form>
        </div>
        {{-- <form action="{{ route('admin.order.import') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" accept=".xlsx">
            <button type="submit">Import</button>
        </form> --}}
        <div class="order_tabContent">
            @include('back.pages.order.section.filter', [
                'order_items' => $order_items,
                'order_unread_count' => $order_unread_count,
            ])

            {{-- {{ $order_items->withQueryString()->links('back.section.pagination') }} --}}
        </div>

    </div>



    <!--================================= Modals ====================================-->
    @include('back.pages.order.section.remove-draft-order', ['reject_reasons' => $reject_reasons])
    @include('back.pages.order.section.edit-draft-order')
    <div class="progressItem-modal">
        <div class="modal">
            <button class="closeProgressItem" type="button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6L6 18M6 6L18 18" stroke="black" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
            <div class="modal-inner"></div>
        </div>
    </div>
    @include('back.pages.order.section.add-railway')
    @include('back.pages.order.section.edit-railway')
    @include('back.pages.order.section.add-declaration')
    @include('back.pages.order.section.add-short-declaration')
    @include('back.pages.order.section.edit-declaration')
    @include('back.pages.order.section.add-images')
    @include('back.pages.order.section.edit-images')
    @include('back.pages.order.section.error-modal')
    {{-- @include('back.pages.order.section.warning-modal') --}}
    @include('back.pages.order.section.warehouse-modal')

    @include('back.pages.order.section.reservation-modal', ['containers' => $containers])
    @include('back.pages.order.section.change-container-modal', ['containers' => $containers])
    @include('back.pages.order.section.add-handover')
    @include('back.pages.order.section.change-cbm-modal')
    @include('back.pages.order.section.combine-order')
    @include('back.pages.order.section.change-user', ['users' => $users])
@endsection

@push('css')
    <style>
        .orders_tab_content {
            margin: 24px auto 0;
            max-width: 1440px;
            width: 100%;
            padding-left: 60px;
            padding-right: 60px;
        }

        .orders_tab_content .containerOrderLink {
            width: max-content;
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 9px 18px;
            font-size: 16px;
            font-weight: 400;
            line-height: 20px;
            color: #fff;
            border-radius: 4px;
            background: #00A3E8;
            margin-bottom: 24px;
        }

        .orders_tab_content .containerOrderLink svg {
            min-width: 24px;
            width: 24px;
            height: 24px;
        }

        .seeDetail {
            position: relative;
        }

        .seeDetail span {
            background: #C61616;
            color: #fff;
            border-radius: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: -8px;
            right: -6px;
            font-size: 11px;
            font-weight: 400;
            line-height: 12px;
            text-align: center;
            padding: 1px 5px;
        }

        .order_tab_btn {
            position: relative;
        }

        .unread-count {
            background: #C61616;
            color: #fff;
            border-radius: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: 8px;
            right: -6px;
            font-size: 11px;
            font-weight: 400;
            line-height: 12px;
            text-align: center;
            padding: 1px 5px;
        }

        .service-count {
            background: #C61616;
            color: #fff;
            border-radius: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: -12px;
            right: -12px;
            font-size: 11px;
            font-weight: 400;
            line-height: 12px;
            text-align: center;
            padding: 1px 5px;
        }

        .green-day.xdsoft_date {
            background-color: #28a745 !important;
            color: white;
        }

        .yellow-day.xdsoft_date {
            background-color: #ffc107 !important;
            color: black;
        }
    </style>
    <style>
        #errorModal {
            display: block;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            /* Arxa fon qaralmış */
        }

        .custom-modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border-radius: 10px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.5);
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .custom-modal-header {
            display: flex;
            align-items: center;
            gap: 10px;
            color: red;
            margin-bottom: 15px;
        }

        .error-icon {
            font-size: 24px;
        }

        #error-list {
            color: red;
            list-style: disc;
            padding-left: 20px;
            margin-bottom: 20px;
        }

        .custom-modal-footer {
            text-align: right;
        }

        #closeModalBtn {
            background-color: red;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            cursor: pointer;
        }

        #closeModalBtn:hover {
            background-color: darkred;
        }
    </style>
    <style>
        /* === Modal Stil === */
        .custom-modal {
            display: none;
            position: fixed;
            z-index: 100;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .custom-modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 30px;
            width: 80%;
            max-width: 700px;
            border-radius: 10px;
            position: relative;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .custom-modal-close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
        }

        /* === Timeline Stil === */
        .timeline {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            margin-top: 40px;
            padding: 20px 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            top: 30px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #ccc;
            z-index: 0;
        }

        .timeline-item {
            position: relative;
            text-align: center;
            z-index: 1;
            flex: 1;
        }

        .timeline-item::before {
            content: '';
            width: 12px;
            height: 12px;
            background-color: #007BFF;
            border-radius: 50%;
            display: block;
            margin: 0 auto;
            position: relative;
            top: 0px;
            z-index: 2;
        }

        .timeline-title {
            font-weight: bold;
            margin-bottom: 10px;
            margin-top: 10px;
        }

        .timeline-file a {
            color: #555;
            text-decoration: none;
        }

        .timeline-date {
            margin-top: 10px;
            font-size: 0.9em;
            color: #555;
        }

        /* Info icon */
        .info-icon {
            width: 28px;
            height: 28px;
            cursor: pointer;
            fill: #007BFF;
        }
    </style>

    <style>
        #warehouse-modal form {
            margin-top: 26px;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            gap: 24px;
        }

        #warehouse-modal form .form-items label {
            font-size: 12px;
            font-weight: 600;
            line-height: 14px;
            text-align: left;
            color: #959595;
            position: absolute;
            padding: 0 2px;
            z-index: 2;
            left: 18px;
            top: -6px;
        }

        #warehouse-modal form .form-items {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            width: 100%;
            gap: 40px 26px;
        }

        #warehouse-modal form .form-items .form-item {
            position: relative;
            width: 100%;
        }

        #warehouse-modal form .form-items .form-item input {
            width: 100%;
            padding: 15px 16px;
            background: #fff;
            border-radius: 8px;
            border: 1px solid #e4e4e4;
            outline: none;
            font-size: 16px;
            font-weight: 400;
            line-height: 22px;
            text-align: left;
            color: #000;
        }

        #warehouse-modal form .form-items .form-item .calendar-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            width: 24px;
            height: 24px;
        }

        .progressOrders th:nth-child(1),
        .progressOrders td:nth-child(1) {
            position: sticky;
            left: 0;
            background: white;
            z-index: 3;
        }

        .progressOrders th:nth-child(2) {
            position: sticky;
            left: 120px;
            background: white;
            z-index: 3;
        }

        .progressOrders td:nth-child(2) {
            position: sticky;
            left: 120px;
            background: white;
            z-index: 3;
        }
    </style>
@endpush

@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
    </script>
    <script src="{{ asset('back/assets') }}/jquery-nice-select-1.1.0/js/jquery.nice-select.min.js"></script>
    <script src="{{ asset('back/assets/select2/select.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function delete_item(item) {
            event.preventDefault();
            let url = item.getAttribute('href');
            let confirm_delete = confirm('Məlumatı silmək istədiyinizdən əminsiniz mi?');
            if (confirm_delete) {
                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            '_token': "{{ csrf_token() }}"
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status == 'success') {
                            toastr.success(data.message);
                            setInterval(() => window.location.reload(), 1500);
                        }
                    });
            }

        }
    </script>
    <script>
        $(document).ready(function() {
            $('select.nice-select').niceSelect();

            $('select.select2').select2();
        });
    </script>
    <script>
        function formatDateToDMY(date) {
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();
            return `${day}.${month}.${year}`;
        }
        let customDates = {};

        let allowedDates = document.querySelector('.allowed-dates').value.split(',');
        allowedDates.forEach(date => {
            customDates[date] = {
                class: 'green-day',
                'tooltip': 'Aktiv'
            };
        });



        jQuery('.booking-datepicker').datetimepicker({
            timepicker: false,
            format: 'd.m.Y',
            beforeShowDay: function(date) {
                const formattedDate = formatDateToDMY(date);
                if (customDates[formattedDate]) {
                    const {
                        class: className,
                        tooltip
                    } = customDates[formattedDate];
                    // class-ları ayrı-ayrı qaytarırıq, hər biri öz yerində
                    return [true, `true ${className}`, tooltip]; // "true" və "className" arasında boşluq olacaq
                }
                return [false, "", "Bu tarix seçilə bilməz"];
            }
        });
    </script>

    <script>
        function change_status(item) {
            let status = item.getAttribute('data-value');
            console.log(status);
            document.querySelector('[name="status"]').value = status;
            filter();
        }

        function open_operations(item) {
            item.classList.toggle('active');
        }
    </script>

    <script>
        function edit_order_price(item) {
            let id = item.getAttribute('data-id');
            let url = `/order/${id}/get-details`;
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    let edit_draft_form = document.querySelector('.edit_draftOrder_modal_container form');
                    let price_column = edit_draft_form.querySelector('[name="price"]');
                    price_column.value = data.data.price ?? 0;
                    let action_url = `/order/${id}/update-price`;
                    edit_draft_form.setAttribute('action', action_url);
                });
        }
    </script>

    <script>
        function reject_order(item) {
            let action = item.getAttribute('data-action');
            let form = document.querySelector('.reject_draftOrder_modal form');
            form.setAttribute('action', action);
        }
    </script>

    <script>
        function get_action(item) {
            let action = item.getAttribute('data-action');
            let form = document.querySelector('.chineReserved_modal_container form');
            form.setAttribute('action', action);
        }

        function get_container_action(item) {
            let action = item.getAttribute('data-action');
            let modal = document.getElementById('change-container-modal');
            let form = modal.querySelector('form');
            modal.classList.add('activeModal');
            form.setAttribute('action', action);
        }

        function close_change_container_modal(item) {
            item.parentElement.parentElement.classList.remove('activeModal');
        }

        function close_handover_modal(item) {
            item.parentElement.parentElement.classList.remove('activeModal');
        }
    </script>

    <script>
        function get_order_data(id) {
            let url = `/order/${id}/get-order-data`;

        }
    </script>

    <script>
        function add_railway(item) {
            event.preventDefault();
            let action = item.getAttribute('data-action');
            let id = item.getAttribute('data-id');
            document.querySelector('.railwayFileModal_container form').setAttribute('action',
                action);
            document.querySelector('.edit_railwayFileModal_container form').setAttribute('action',
                action);
            let url = `/order/${id}/get-railway-bill`;
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.file != '') {
                        let file = data.file.split('/')[2];
                        let html =
                            `<img src="{{ asset('back/assets') }}/images/pdfImg.svg" alt="">
                                        <div class="edit_railWayFile-fileUpload-main">
                                            <div class="edit_railWayFile-fileUpload-top">
                                                <span class="edit_railWayFile-FileName">${file}</span>
                                                <p class="edit_railWayFile-fileSize">5 Mb</p>
                                            </div>
                                            <div class="edit_railWayFile-fileProgress">
                                                <div class="uploadLine" style="width: 100%;"></div>
                                            </div>
                                        </div>
                                        <button class="edit_removeRailWayFile" type="button">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.5 4.5L4.5 13.5M4.5 4.5L13.5 13.5" stroke="#FF0000" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>`;

                        document.querySelector('.edit_railWayFile-fileUpload').innerHTML = html;
                    }
                });
        }

        function add_declaration(item) {
            event.preventDefault();
            let action = item.getAttribute('data-action');
            let id = item.getAttribute('data-id');
            document.querySelector('.declarationFileModal_container form').setAttribute('action', action);
            document.querySelector('.edit_declarationFileModal_container form').setAttribute('action', action);
            let url = `/order/${id}/get-declaration`;
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.file != '') {
                        let file = data.file.split('/')[2];
                        let html = `
                                    <img src="{{ asset('back/assets') }}/images/pdfImg.svg" alt="">
                                    <div class="edit_declarationFile-fileUpload-main">
                                        <div class="edit_declarationFile-fileUpload-top">
                                            <span class="edit_declarationFile-FileName">${file}</span>
                                            <p class="edit_declarationFile-fileSize">5 MB</p>
                                        </div>
                                        <div class="edit_declarationFile-fileProgress">
                                            <div class="uploadLine" style="width: 100%;"></div>
                                        </div>
                                    </div>
                                    <button class="edit_removeDeclarationFile" type="button">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.5 4.5L4.5 13.5M4.5 4.5L13.5 13.5" stroke="#FF0000" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>`;

                        document.querySelector('.edit_declarationFile-fileUpload').innerHTML = html;
                    }
                })

        }

        function add_images(item) {
            event.preventDefault();
            let action = item.getAttribute('data-action');
            let id = item.getAttribute('data-id');
            document.querySelector('.containerImgModal_container form').setAttribute('action', action);
            document.querySelector('.edit_containerImgModal_container form').setAttribute('action', action);
            let url = `/order/${id}/get-images`;
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.length > 0) {
                        let image_container = document.querySelector('.edit_containerImgFiles');
                        let html = '';
                        data.forEach(item => {
                            console.log(item.image);
                            let image = item.image.split('/')[2];
                            html += `<div class="edit_containerImgFile-fileUpload">
                                        <img src="{{ asset('back/assets') }}/images/pdfImg.svg" alt="">
                                        <div class="edit_containerImgFile-fileUpload-main">
                                            <div class="edit_containerImgFile-fileUpload-top">
                                                <span class="edit_containerImgFile-FileName">${image}</span>
                                                <p class="edit_containerImgFile-fileSize">10 MB</p>
                                            </div>
                                            <div class="edit_containerImgFile-fileProgress">
                                                <div class="uploadLine" style="width:100%;"></div>
                                            </div>
                                        </div>
                                        <button onclick='delete_image(this)' data-id='${item.id}'  class="edit_removeContainerImgFile" type="button">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.5 4.5L4.5 13.5M4.5 4.5L13.5 13.5" stroke="#FF0000" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </div>`;
                            image_container.innerHTML = html;
                        });
                    }
                });
        }

        function delete_image(item) {
            let id = item.getAttribute('data-id');
            let url = `/order/${id}/delete-image`;
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        toastr.success(data.message);
                        item.parentElement.remove();
                    } else toastr.error(data.message);
                });
        }
    </script>

    <script>
        function get_order_details(id) {
            event.preventDefault();
            let url = `/order/${id}/details`;
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        console.log(document.querySelector('.progressItem-modal .modal-inner'));
                        document.querySelector('.progressItem-modal .modal-inner').innerHTML = data.view;
                        document.querySelector('.progressItem-modal').classList.add('activeModal');
                    }
                });
        }
    </script>

    <script>
        function change_railway_status(id, status) {

            Swal.fire({
                title: "Statusu dəyişmək istədiyinizdən əminsiniz mi?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Bəli!",
                cancelButtonText: 'Xeyr!',
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = `/order/${id}/change-railway-status`;
                    fetch(url, {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                '_token': "{{ csrf_token() }}",
                                'status': status
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            console.log(data);
                            if (data.status == 'success') {
                                toastr.success(data.message);
                                document.querySelector('.railway_buttons').style.display = 'none';
                            } else {
                                toastr.error(data.message);
                            }
                        });
                    // Swal.fire({
                    //     title: "Deleted!",
                    //     text: "Status uğurla dəyişdirildi.",
                    //     icon: "success"
                    // });
                }
            });

        }
    </script>

    <script>
        function send_comment(item) {
            event.preventDefault();
            let url = item.getAttribute('data-url');
            let text = document.querySelector('[name="text"]');
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        '_token': "{{ csrf_token() }}",
                        'text': text.value,
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        let comment_write_area = document.querySelector('.comment-write-area');
                        let html = `<div class="comment-item">
                                <h4 class="userName">${data.data.user}</h4>
                                <div class="comment-txt">
                                    <p>${data.data.text}</p>
                                </div>
                                <span class="comment-time">${data.data.time}</span>
                            </div>`;
                        comment_write_area.insertAdjacentHTML('beforeend', html);
                        text.value = '';
                        toastr.success(data.message);
                    }

                });
        }
    </script>

    <script>
        document.getElementById('closeModalBtn').addEventListener('click', function() {
            document.getElementById('errorModal').style.display = 'none';
        });
    </script>

    <script>
        function get_handover_action(item) {
            let action = item.getAttribute('data-action');
            let modal = document.getElementById('add-handover');
            modal.classList.add('activeModal');
            let form = modal.querySelector('form');
            form.setAttribute('action', action);
        }
    </script>

    <script>
        function get_short_declaration_action(item) {
            let action = item.getAttribute('data-action');
            let modal = document.getElementById('add-short-declaration');
            modal.classList.add('activeModal');
            let form = modal.querySelector('form');
            form.setAttribute('action', action);

            document.querySelector('#add-short-declaration .closeDeclarationFileModal').addEventListener('click',
                function() {
                    document.querySelector('#add-short-declaration').classList.remove('activeModal');
                });
            let input = document.querySelector('#add-short-declaration input[type="file"]');
            let uploadArea = document.querySelector('#add-short-declaration .declarationFile-fileUpload');
            let uploadLine = document.querySelector('#add-short-declaration .uploadLine');
            let fileNameSpan = document.querySelector('#add-short-declaration .declarationFile-FileName');
            let fileSizeP = document.querySelector('#add-short-declaration .declarationFile-fileSize');
            input?.addEventListener("change", async function() {
                if (this.files.length > 0) {
                    uploadArea.style.display = "flex";
                    const file = this.files[0];
                    fileNameSpan.textContent = file.name;

                    // Dosya boyutunu MB olarak hesapla
                    const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                    fileSizeP.textContent = `${fileSizeMB} MB`;

                    // Yükleme çubuğunu sıfırla
                    uploadLine.style.transition = "none";
                    uploadLine.style.width = "0%";

                    // 100ms gecikme ile animasyon sıfırlama
                    await new Promise((resolve) => setTimeout(resolve, 100));

                    uploadLine.style.transition = "width 0.5s linear";
                    simulateFileUpload(uploadLine);
                } else {
                    fileNameSpan.textContent = "";
                    fileSizeP.textContent = "";
                    uploadLine.style.width = "0%";
                }
            });

            const simulateFileUpload = (uploadLine) => {
                let progress = 0;
                const interval = setInterval(() => {
                    progress += Math.random() * 10; // Rastgele ilerleme

                    if (progress >= 100) {
                        progress = 100;
                        uploadLine.style.width = `${progress}%`;
                        uploadLine.style.backgroundColor = "#32b558"; // ✅ Tamamlandıqda yaşıl
                        uploadLine.parentElement.parentElement.nextElementSibling.style.display = "none";
                        clearInterval(interval);
                    } else {
                        uploadLine.style.width = `${progress}%`;
                        uploadLine.style.backgroundColor = "#00a3e8"; // Yükləmə zamanı mavi
                        uploadLine.parentElement.parentElement.nextElementSibling.style.display =
                            "inline-block";
                    }
                }, 50);
            };
        }
    </script>

    <script>
        function get_start_date(item) {
            let start_date = item.value;
            document.querySelector('[name="start_date"]').value = start_date;
        }

        function get_end_date(item) {
            let end_date = item.value;
            document.querySelector('[name="end_date"]').value = end_date;
        }

        function get_type(item) {
            document.querySelector('[name="type"]').value = item.value;
        }

        function get_sort_by(item) {
            document.querySelector('[name="sort_by"]').value = item.value;
        }

        function get_limit(item) {
            document.querySelector('[name="limit"]').value = item.value;
        }
    </script>

    <script>
        function open_log_modal() {
            document.querySelector('#infoModal').style.display = 'block';
        }

        function close_log_modal() {
            document.querySelector('#infoModal').style.display = 'none';
        }
    </script>

    <script>
        function get_containers(item) {
            let id = item.value;
            let date = document.querySelector('#booking-modal [name="date"]').value;
            let url = `/container-type/${id}/get-containers?booking_date=${date}`;
            console.log(url);
            let container_id = document.querySelector('.chineReserved_modal_container [name="container_id"]');
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        container_id.innerHTML = '<option value="">Seçin</option>';
                        data.data.forEach(item => {
                            container_id.innerHTML +=
                                `<option value="${item.id}" >${item.code} (${item.empty_volume})</option>`;
                        });
                    }
                });
        }
    </script>

    <script>
        function get_change_cbm_action(item) {
            let modal = document.getElementById('change-cbm');
            let id = item.getAttribute('data-id');
            let order_item_id = modal.querySelector('[name="order_item_id"]');
            modal.classList.add('activeModal');
            order_item_id.value = id;
        }

        function close_change_cbm_modal(item) {
            item.parentElement.parentElement.classList.remove('activeModal');
        }

        function change_cbm(item) {
            let action = item.getAttribute('data-action');
            let form = document.querySelector('#change-cbm form');
            form.setAttribute('action', action);
            let form_items = form.querySelector('.form-items');
            let submit_buttons = document.querySelector('.submit-buttons');
            let confirm_buttons = document.querySelector('.confirm-buttons');
            let id = document.querySelector('[name="order_item_id"]').value;
            let url = `/order/${id}/get-cbm-info`;
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        form_items.innerHTML = `
                            <div class="form-item" style="width:45%;">
                                <label>Cari CBM</label>
                                <input name="old_cbm" disabled value="${data.cbm}" >
                            </div>
                            <div class="form-item" style="width:45%;" >
                                <label>Yeni CBM</label>
                                <input required name="new_cbm" oninput="convert_numeric(this)">
                            </div>
                            `;
                        submit_buttons.style.display = 'block';
                        confirm_buttons.style.display = 'none';

                        let confirm_button = document.getElementById('confirm-button');

                        confirm_button.addEventListener('click', function() {
                            event.preventDefault();
                            let new_cbm = document.querySelector('[name="new_cbm"]').value;
                            fetch(action, {
                                    method: 'POST',
                                    headers: {
                                        'Accept': 'application/json',
                                        'Content-Type': 'application/json',
                                    },
                                    body: JSON.stringify({
                                        '_token': "{{ csrf_token() }}",
                                        'order_item_id': id,
                                        'new_cbm': new_cbm,
                                    })
                                })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.status == 'success') {
                                        toastr.success(data.message);
                                        divide_order(document.getElementById('divide-order'));
                                    } else {
                                        toastr.error(data.message);
                                    }
                                });
                        });
                    }
                });
        }

        function divide_order(item) {
            let action = item.getAttribute('data-action');
            let form = document.querySelector('#change-cbm form');
            form.setAttribute('action', action);
            let form_items = form.querySelector('.form-items');
            let submit_buttons = document.querySelector('.submit-buttons');
            let confirm_buttons = document.querySelector('.confirm-buttons');
            let id = document.querySelector('[name="order_item_id"]').value;
            let url = `/order/${id}/get-cbm-info`;
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        form_items.innerHTML = `
                            <div class="form-item" style="width:45%;">
                                <label>Cari CBM</label>
                                <input name="old_cbm" disabled value="${data.cbm}" >
                            </div>
                            <div class="form-item" style="width:45%">
                                <label>Yer sayı</label>
                                <select onchange="get_place_count(this)" class="select2">
                                    <option value="" >Yer sayı</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                            <div style="display:grid; grid-template-columns:repeat(2,1fr); gap:20px;" class="place-count"></div>
                            `;
                        submit_buttons.style.display = 'block';
                        confirm_buttons.style.display = 'none';
                        $('.select2').select2();

                        let confirm_button = document.getElementById('confirm-button');

                        confirm_button.addEventListener('click', function() {
                            event.preventDefault();
                            let cbms = document.querySelectorAll('[name="new_cbm[]"]');
                            let new_cbm = [];
                            cbms.forEach(cbm => {
                                new_cbm.push(cbm.value);
                            });
                            fetch(action, {
                                    method: 'POST',
                                    headers: {
                                        'Accept': 'application/json',
                                        'Content-Type': 'application/json',
                                    },
                                    body: JSON.stringify({
                                        '_token': "{{ csrf_token() }}",
                                        'order_item_id': id,
                                        'new_cbm': new_cbm,
                                    })
                                })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.status == 'success') {
                                        toastr.success(data.message);
                                        divide_order(document.getElementById('divide-order'));
                                        document.getElementById('change-cbm').classList.remove(
                                            'activeModal');
                                        setTimeout(() => window.location.reload(), 1500);
                                    } else {
                                        console.log(data.message);
                                    }
                                });
                        })
                    }
                });
        }

        function reverse_operation() {
            document.querySelector('#change-cbm .form-items').innerHTML = '';
            document.querySelector('#change-cbm .submit-buttons').style.display = 'none';
            document.querySelector('#change-cbm .confirm-buttons').style.display = 'block';
        }

        function get_place_count(item) {
            let value = item.value;
            let place_count = document.querySelector('.place-count');
            place_count.innerHTML = '';
            for (let i = 1; i <= value; i++) {
                place_count.innerHTML += `<div class="form-item" >
                        <label>CBM</label>
                        <input required name="new_cbm[]" oninput="convert_numeric(this)" />
                    </div>`;
            }
        }
    </script>

    <script>
        function filter(page = 1) {
            event.preventDefault();
            get_limit(document.getElementById('limit'));
            get_start_date(document.getElementById('start_date'));
            get_end_date(document.getElementById('end_date'));
            get_type(document.getElementById('type'));
            get_sort_by(document.getElementById('sort_by'));

            let limit = document.querySelector('[name="limit"]').value;
            let start_date = document.querySelector('[name="start_date"]').value;
            let end_date = document.querySelector('[name="end_date"]').value;
            let type = document.querySelector('[name="type"]').value;
            let search = document.querySelector('[name="search"]').value;
            let sort_by = document.querySelector('[name="sort_by"]').value;
            let status = document.querySelector('[name="status"]').value;

            let params = new URLSearchParams();
            params.append("page", page);
            if (limit) params.append("limit", limit);
            if (start_date) params.append("start_date", start_date);
            if (end_date) params.append("end_date", end_date);
            if (type) params.append("type", type);
            if (sort_by) params.append("sort_by", sort_by);
            if (search) params.append("search", search);
            if (status) params.append('status', status);
            let newUrl = `/order?${params.toString()}`;
            let url = `/order/filter?${params.toString()}`;
            history.pushState(null, "", newUrl);
            let order_tabContent = document.querySelector('.order_tabContent');

            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        order_tabContent.innerHTML = data.view;
                        active_tab_content();
                        const chine_operation_btns = document.querySelectorAll(".chine-operation-btn");
                        chine_operation_btns.forEach((btn) => {
                            btn.addEventListener("click", (e) => {
                                e.stopPropagation();
                                const parent = btn.parentElement;
                                if (parent.classList.contains("active")) {
                                    parent.classList.remove("active");
                                } else {
                                    chine_operation_btns.forEach((btn2) =>
                                        btn2.parentElement.classList.remove("active")
                                    );
                                    parent.classList.add("active");
                                }
                            });
                        });

                        const chineReserved_modal_container = document.querySelector(
                            ".chineReserved_modal_container"
                        );
                        const closeChineReservedModal = document.querySelector(
                            ".closeChineReservedModal"
                        );
                        const chineBeReservations = document.querySelectorAll(".chineBeReservation");
                        chineBeReservations.forEach((btn) => {
                            btn?.addEventListener("click", () => {
                                chineReserved_modal_container.classList.add("activeModal");
                            });
                        });

                        closeChineReservedModal?.addEventListener("click", () => {
                            chineReserved_modal_container.classList.remove("activeModal");
                        });
                    } else {}
                });
        }
    </script>

    <script>
        function convert_numeric(item) {
            // Yalnız rəqəmlərə və bir ədəd nöqtəyə icazə ver
            let cleaned = item.value.replace(/[^0-9.]/g, '');

            // Bir dənədən çox nöqtə varsa, yalnız birincisini saxla
            const parts = cleaned.split('.');
            if (parts.length > 2) {
                cleaned = parts[0] + '.' + parts.slice(1).join('');
            }

            // Əgər ədəd onluq DEYİLSƏ və sıfırla başlayırsa, sıfırı sil
            if (!cleaned.includes('.') && cleaned.startsWith('0') && cleaned.length > 1) {
                cleaned = cleaned.replace(/^0+/, '');
            }

            item.value = cleaned;
        }
    </script>

    <script>
        function combine_order_modal(item) {
            let action = item.getAttribute('data-action');
            document.getElementById('combine-order').classList.add('activeModal');
            document.querySelector('#combine-order form').setAttribute('action', action);
        }

        function close_combine_order_modal() {
            document.getElementById('combine-order').classList.remove('activeModal');
        }
    </script>

    <script>
        function get_user_change_modal(item) {
            let action = item.getAttribute('data-action');
            document.getElementById('change-user-modal').classList.add('activeModal');
            document.querySelector('#change-user-modal form').setAttribute('action', action);
        }

        function close_user_change_modal() {
            document.getElementById('change-user-modal').classList.remove('activeModal');
        }
    </script>

    <script>
        function open_warehouse_modal(item) {
            let action = item.getAttribute('data-action');
            let warehouse_modal = document.getElementById('warehouse-modal');
            warehouse_modal.classList.add('activeModal');
            warehouse_modal.querySelector('form').setAttribute('action', action);
        }

        function close_warehouse_modal() {
            document.getElementById('warehouse-modal').classList.remove('activeModal');
        }
    </script>

    <script>
        function submit_order() {
            document.getElementById('booking-modal').classList.add('activeModal');
        }

        function close_create_order_modal() {
            document.getElementById('create-order-modal').classList.remove('activeModal');
        }

        function close_booking_modal(item) {
            item.classList.remove('activeModal');
        }
    </script>
@endpush
