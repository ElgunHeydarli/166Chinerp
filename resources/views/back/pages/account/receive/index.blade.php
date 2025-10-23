@extends('back.layouts.master')

@section('content')
    <div class="finance_tab_content">
        <!-- finance-head classli div elave edildi -->
        <div class="tabContent-head">
            <form action="" class="table-search">
                <input type="text" name="search" oninput="filter()" value="{{ request('search') }}" placeholder="Axtar" />
                <button class="submitForm" type="submit">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="11.5" cy="11.5" r="9.5" stroke="#fff" stroke-width="1.5" />
                        <path d="M18.5 18.5L22 22" stroke="#fff" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </button>
            </form>
            <div class="filterColumns">
                <input type="text" class="datetimepicker" onchange="filter()" name="start_date"
                    value="{{ request('start_date') }}" placeholder="Start Time" />
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
                <input type="text" class="datetimepicker" onchange="filter()" name="end_date"
                    value="{{ request('end_date') }}" placeholder="End Time" />
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
            <select name="status" onchange="filter()" id="" class="nice-select receivable_status">
                <option value="">Status</option>
                <option value="{{ \App\Enums\ReceiveStatus::PENDING }}"
                    {{ request('status') == \App\Enums\ReceiveStatus::PENDING ? 'selected' : '' }}>
                    {{ \App\Enums\ReceiveStatus::PENDING->label() }}
                </option>
                <option value="{{ \App\Enums\ReceiveStatus::PAID }}"
                    {{ request('status') == \App\Enums\ReceiveStatus::PAID ? 'selected' : '' }}>
                    {{ \App\Enums\ReceiveStatus::PAID->label() }}
                </option>
                <option value="{{ \App\Enums\ReceiveStatus::NOT_PAID }}"
                    {{ request('status') == \App\Enums\ReceiveStatus::NOT_PAID ? 'selected' : '' }}>
                    {{ \App\Enums\ReceiveStatus::NOT_PAID->label() }}
                </option>
            </select>
            <a href="{{ route('admin.receive.create') }}" class="addReceivable">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 12H12M12 12H6M12 12V6M12 12V18" stroke="white" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                Əlavə et
            </a>
        </div>
        <div class="finance_tabContent_inner">
            @include('back.pages.account.receive.section.tab-header')
            <div class="receivableTable">
                @include('back.pages.account.receive.section.filter', ['receives' => $receives])
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function filter(page = 1) {
            event.preventDefault();
            let search = document.querySelector('[name="search"]').value;
            let start_date = document.querySelector('[name="start_date"]').value;
            let end_date = document.querySelector('[name="end_date"]').value;
            let status = document.querySelector('[name="status"]').value;

            let params = new URLSearchParams();
            params.append("page", page);

            if (start_date) params.append("start_date", start_date);
            if (end_date) params.append("end_date", end_date);
            if (search) params.append("search", search);
            if (status) params.append("status", status);

            let newUrl = `/receive?${params.toString()}`;
            let url = `/receive/filter?${params.toString()}`;
            history.pushState(null, "", newUrl);

            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        document.querySelector('.receivableTable').innerHTML = data.view;
                    }
                });
        }
    </script>
@endpush
