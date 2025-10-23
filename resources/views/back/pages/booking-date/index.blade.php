@extends('back.layouts.master')

@section('content')
    <div class="reservateDate-container">
        <div class="reservateDate-header">
            <form action="" class="table-search">
                <input type="text" placeholder="Axtar">
                <button class="submitForm" type="submit">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="11.5" cy="11.5" r="9.5" stroke="#fff" stroke-width="1.5" />
                        <path d="M18.5 18.5L22 22" stroke="#fff" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </button>
            </form>

            {{-- <form action="{{ route('admin.booking-date.import') }}" method="post" enctype="multipart/form-data"
                class="table-search">
                @csrf
                <input type="file" name="file" accept=".xlsx">
                <button class="submitForm" type="submit">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="11.5" cy="11.5" r="9.5" stroke="#fff" stroke-width="1.5" />
                        <path d="M18.5 18.5L22 22" stroke="#fff" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </button>
            </form> --}}
            @can('Rezervasiya tarixləri page-Əlavə et')
                <a href="{{ route('admin.booking-date.create') }}" class="addReservationLink">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 12H12M12 12H6M12 12V6M12 12V18" stroke="white" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    Əlavə et
                </a>
            @endcan
        </div>
        <div class="reservateDate_head">
            <div class="reservateDate_head_inner">
                @can('Rezervasiya tarixləri page')
                    <a style="display: inline-block;" href="{{ route('admin.booking-date.index', ['type' => 'booking_date']) }}"
                        class="reservateDate_tab_btn {{ request('type', 'booking_date') == 'booking_date' ? 'active' : '' }}"
                        id="reservateDates">Rezarvasiya tarixləri</a>
                @endcan
                @can('Yoxlamada olan konteynerlər page')
                    <a style="display: inline-block;"
                        href="{{ route('admin.booking-date.index', ['type' => 'checked_container']) }}"
                        class="reservateDate_tab_btn {{ request('type', 'booking_date') == 'checked_container' ? 'active' : '' }}"
                        id="containerIsCheck">Yoxlamada olan konternerlar</a>
                @endcan
            </div>
        </div>

        @can('Rezervasiya tarixləri page')
            <div class="sub_reservateDateTabContent reservateDateContent"
                style="display : {{ request('type', 'booking_date') == 'booking_date' ? 'block' : 'none' }};"
                data-id="reservateDates">
                <div class="reservateDateContent-main">
                    <div class="reservateDate-filter">
                        <p class="result">
                            <span>{{ count($booking_dates) }}</span> nəticə
                        </p>
                        <div class="filter-item">
                            <div class="icon">
                                <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M2.5 8.97323C2.5 9.73927 2.65088 10.4978 2.94404 11.2055C3.23719 11.9133 3.66687 12.5563 4.20854 13.098C4.75022 13.6397 5.39328 14.0694 6.10101 14.3625C6.80875 14.6557 7.56729 14.8066 8.33333 14.8066C9.09938 14.8066 9.85792 14.6557 10.5657 14.3625C11.2734 14.0694 11.9164 13.6397 12.4581 13.098C12.9998 12.5563 13.4295 11.9133 13.7226 11.2055C14.0158 10.4978 14.1667 9.73927 14.1667 8.97323C14.1667 8.20718 14.0158 7.44864 13.7226 6.74091C13.4295 6.03317 12.9998 5.39011 12.4581 4.84844C11.9164 4.30676 11.2734 3.87708 10.5657 3.58393C9.85792 3.29078 9.09938 3.13989 8.33333 3.13989C7.56729 3.13989 6.80875 3.29078 6.10101 3.58393C5.39328 3.87708 4.75022 4.30676 4.20854 4.84844C3.66687 5.39011 3.23719 6.03317 2.94404 6.74091C2.65088 7.44864 2.5 8.20718 2.5 8.97323Z"
                                        stroke="#534D59" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M17.5 18.1399L12.5 13.1399" stroke="#534D59" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>

                            </div>
                            <input type="text" placeholder="Axtar">
                        </div>
                    </div>
                    <div class="reservateDate-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tarix</th>
                                    <th>Konteyner sayı</th>
                                    <th>Cəmi CBM</th>
                                    <th>Qalan CBM</th>
                                    <th>Qalan konteyner sayı</th>
                                    @canany([
                                        'Rezervasiya tarixləri page - Əməliyyatlar - Bax',
                                        'Rezervasiya tarixləri page-
                                        Əməliyyatlar - Düzəlt',
                                        'Rezervasiya tarixləri page - Əməliyyatlar - Statusu dəyiş',
                                        ])
                                        <th>&nbsp;</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($booking_dates as $booking_date)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $booking_date->date?->format('d.m.Y') ?? 'Yoxdur' }}</td>
                                        <td>{{ $booking_date->count }}</td>
                                        <td>{{ $booking_date->total_cbm }}</td>
                                        <td>{{ $booking_date->remainder_cbm }}</td>
                                        <td>{{ $booking_date->count - count($booking_date->containers->where('status', 1)) }}
                                        </td>
                                        @canany([
                                            'Rezervasiya tarixləri page - Əməliyyatlar - Bax',
                                            'Rezervasiya tarixləri page
                                            - Əməliyyatlar - Düzəlt',
                                            'Rezervasiya tarixləri page - Əməliyyatlar - Statusu dəyiş',
                                            ])
                                            <td>
                                                <div class="reservateDate-operation">
                                                    <button class="reservateDate-operation-btn" type="button">
                                                        Əməliyyat
                                                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_22_2058)">
                                                                <path d="M5 7.38989L9.5 11.8899L14 7.38989" stroke="black"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_22_2058">
                                                                    <rect width="18" height="18" fill="white"
                                                                        transform="translate(0.5 0.639893)" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </button>
                                                    <div class="reservateDate-operation-links">
                                                        @can('Rezervasiya tarixləri page - Əməliyyatlar - Bax')
                                                            <a href="{{ route('admin.booking-date.detail', $booking_date->id) }}"
                                                                class="reservateDate-operation-link reservateDateView" type="button">
                                                                <svg width="24" height="25" viewBox="0 0 24 25"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M10 12.6399C10 13.1703 10.2107 13.679 10.5858 14.0541C10.9609 14.4292 11.4696 14.6399 12 14.6399C12.5304 14.6399 13.0391 14.4292 13.4142 14.0541C13.7893 13.679 14 13.1703 14 12.6399C14 12.1095 13.7893 11.6008 13.4142 11.2257C13.0391 10.8506 12.5304 10.6399 12 10.6399C11.4696 10.6399 10.9609 10.8506 10.5858 11.2257C10.2107 11.6008 10 12.1095 10 12.6399Z"
                                                                        stroke="#534D59" stroke-width="1.5" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                    <path
                                                                        d="M21 12.6399C18.6 16.6399 15.6 18.6399 12 18.6399C8.4 18.6399 5.4 16.6399 3 12.6399C5.4 8.63989 8.4 6.63989 12 6.63989C15.6 6.63989 18.6 8.63989 21 12.6399Z"
                                                                        stroke="#534D59" stroke-width="1.5" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                </svg>
                                                                Bax
                                                            </a>
                                                        @endcan
                                                        @can('Rezervasiya tarixləri page - Əməliyyatlar - Düzəlt')
                                                            <a href="{{ route('admin.booking-date.edit', $booking_date->id) }}"
                                                                class="reservateDate-operation-link editReservateDate" type="button">
                                                                <svg width="24" height="25" viewBox="0 0 24 25"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M19.5 12.6399C19.5 12.441 19.579 12.2502 19.7197 12.1096C19.8603 11.9689 20.0511 11.8899 20.25 11.8899C20.4489 11.8899 20.6397 11.9689 20.7803 12.1096C20.921 12.2502 21 12.441 21 12.6399V20.8899C21 21.0888 20.921 21.2796 20.7803 21.4202C20.6397 21.5609 20.4489 21.6399 20.25 21.6399H3.75C3.55109 21.6399 3.36032 21.5609 3.21967 21.4202C3.07902 21.2796 3 21.0888 3 20.8899V4.38989C3 4.19098 3.07902 4.00021 3.21967 3.85956C3.36032 3.71891 3.55109 3.63989 3.75 3.63989H12C12.1989 3.63989 12.3897 3.71891 12.5303 3.85956C12.671 4.00021 12.75 4.19098 12.75 4.38989C12.75 4.5888 12.671 4.77957 12.5303 4.92022C12.3897 5.06087 12.1989 5.13989 12 5.13989H4.5V20.1399H19.5V12.6399Z"
                                                                        fill="#534D59" />
                                                                    <path
                                                                        d="M11.0145 13.6298L12.252 13.4528L19.854 5.85228C19.9256 5.78309 19.9827 5.70034 20.0221 5.60883C20.0614 5.51733 20.082 5.41891 20.0829 5.31933C20.0838 5.21975 20.0648 5.12099 20.0271 5.02881C19.9894 4.93664 19.9337 4.8529 19.8633 4.78248C19.7929 4.71206 19.7091 4.65637 19.6169 4.61866C19.5248 4.58095 19.426 4.56198 19.3264 4.56284C19.2268 4.56371 19.1284 4.5844 19.0369 4.6237C18.9454 4.66301 18.8627 4.72015 18.7935 4.79178L11.19 12.3923L11.013 13.6298H11.0145ZM20.9145 3.72978C21.1236 3.93873 21.2894 4.18683 21.4026 4.45991C21.5158 4.73299 21.574 5.02568 21.574 5.32128C21.574 5.61687 21.5158 5.90957 21.4026 6.18265C21.2894 6.45573 21.1236 6.70383 20.9145 6.91278L13.137 14.6903C13.0223 14.8054 12.8733 14.8801 12.7125 14.9033L10.2375 15.2573C10.1221 15.2738 10.0045 15.2633 9.89395 15.2265C9.78339 15.1897 9.68293 15.1276 9.60053 15.0452C9.51813 14.9628 9.45607 14.8624 9.41926 14.7518C9.38245 14.6412 9.37191 14.5236 9.38848 14.4083L9.74248 11.9333C9.7652 11.7726 9.83942 11.6237 9.95398 11.5088L17.733 3.73128C18.1549 3.30947 18.7271 3.07251 19.3237 3.07251C19.9203 3.07251 20.4925 3.30947 20.9145 3.73128V3.72978Z"
                                                                        fill="#534D59" />
                                                                </svg>
                                                                Düzəlt
                                                            </a>
                                                        @endcan
                                                        @can('Rezervasiya tarixləri page - Əməliyyatlar - Statusu dəyiş')
                                                            <button class="reservateDate-operation-link changeStatusReservateDate"
                                                                data-action="{{ route('admin.booking-date.change-status', $booking_date->id) }}"
                                                                data-id="{{ $booking_date->id }}" type="button"
                                                                onclick="change_booking_date_status(this)">
                                                                <svg width="22" height="23" viewBox="0 0 22 23"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M1.8335 5.68156L2.94659 7.05656L6.87516 3.38989"
                                                                        stroke="#534D59" stroke-width="1.5" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                    <path d="M1.8335 12.0983L2.94659 13.4733L6.87516 9.80664"
                                                                        stroke="#534D59" stroke-width="1.5" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                    <path d="M1.8335 18.5148L2.94659 19.8898L6.87516 16.2231"
                                                                        stroke="#534D59" stroke-width="1.5" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                    <path d="M20.1667 18.0566L11 18.0566" stroke="#534D59"
                                                                        stroke-width="1.5" stroke-linecap="round" />
                                                                    <path d="M20.1667 11.6399L11 11.6399" stroke="#534D59"
                                                                        stroke-width="1.5" stroke-linecap="round" />
                                                                    <path d="M20.1667 5.22314L11 5.22314" stroke="#534D59"
                                                                        stroke-width="1.5" stroke-linecap="round" />
                                                                </svg>

                                                                Statusu dəyiş
                                                            </button>
                                                        @endcan
                                                        @can('Rezervasiya tarixləri page - Əməliyyatlar - Sil')
                                                            <a class="reservateDate-operation-link"
                                                                href="{{ route('admin.booking-date.destroy', $booking_date->id) }}"
                                                                onclick="delete_item(this)">
                                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M8.4 16.308L12 12.708L15.6 16.308L16.308 15.6L12.708 12L16.308 8.4L15.6 7.692L12 11.292L8.4 7.692L7.692 8.4L11.292 12L7.692 15.6L8.4 16.308ZM12.003 21C10.759 21 9.589 20.764 8.493 20.292C7.39767 19.8193 6.44467 19.178 5.634 18.368C4.82333 17.558 4.18167 16.606 3.709 15.512C3.23633 14.418 3 13.2483 3 12.003C3 10.7577 3.23633 9.58767 3.709 8.493C4.181 7.39767 4.82133 6.44467 5.63 5.634C6.43867 4.82333 7.391 4.18167 8.487 3.709C9.583 3.23633 10.753 3 11.997 3C13.241 3 14.411 3.23633 15.507 3.709C16.6023 4.181 17.5553 4.82167 18.366 5.631C19.1767 6.44033 19.8183 7.39267 20.291 8.488C20.7637 9.58333 21 10.753 21 11.997C21 13.241 20.764 14.411 20.292 15.507C19.82 16.603 19.1787 17.556 18.368 18.366C17.5573 19.176 16.6053 19.8177 15.512 20.291C14.4187 20.7643 13.249 21.0007 12.003 21ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                                                        fill="#534D59" />
                                                                </svg>
                                                                Sil
                                                            </a>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </td>
                                        @endcanany
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <div class="pagination">
                <a href="" class="prev">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 5L9 12L15 19" stroke="#fff" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>
                <a href="" class="pagination_item active">1</a>
                <a href="" class="pagination_item">2</a>
                <p class="pagination_item">...</p>
                <a href="" class="pagination_item">10</a>
                <a href="" class="next">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 5L15 12L9 19" stroke="#fff" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>
            </div> --}}
                {{-- @include('back.pages.booking-date.section.booking-date-view') --}}
            </div>
        @endcan

        @can('Yoxlamada olan konteynerlər page')
            <div class="sub_reservateDateTabContent containerIsCheck"
                style="display : {{ request('type', 'booking_date') == 'checked_container' ? 'block' : 'none' }};"
                data-id="containerIsCheck">
                <div class="containerIsCheck-main">
                    <div class="containerIsCheck-filter">
                        <p class="result">
                            <span>12</span> nəticə
                        </p>
                        <div class="filter-item">
                            <div class="icon">
                                <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M2.5 8.97323C2.5 9.73927 2.65088 10.4978 2.94404 11.2055C3.23719 11.9133 3.66687 12.5563 4.20854 13.098C4.75022 13.6397 5.39328 14.0694 6.10101 14.3625C6.80875 14.6557 7.56729 14.8066 8.33333 14.8066C9.09938 14.8066 9.85792 14.6557 10.5657 14.3625C11.2734 14.0694 11.9164 13.6397 12.4581 13.098C12.9998 12.5563 13.4295 11.9133 13.7226 11.2055C14.0158 10.4978 14.1667 9.73927 14.1667 8.97323C14.1667 8.20718 14.0158 7.44864 13.7226 6.74091C13.4295 6.03317 12.9998 5.39011 12.4581 4.84844C11.9164 4.30676 11.2734 3.87708 10.5657 3.58393C9.85792 3.29078 9.09938 3.13989 8.33333 3.13989C7.56729 3.13989 6.80875 3.29078 6.10101 3.58393C5.39328 3.87708 4.75022 4.30676 4.20854 4.84844C3.66687 5.39011 3.23719 6.03317 2.94404 6.74091C2.65088 7.44864 2.5 8.20718 2.5 8.97323Z"
                                        stroke="#534D59" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M17.5 18.1399L12.5 13.1399" stroke="#534D59" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>

                            </div>
                            <input type="text" placeholder="Axtar">
                        </div>
                    </div>
                    <button onclick="set_booking_date()" class="setReservationDateBtn" type="button">
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M4 7.64014C4 7.1097 4.21071 6.601 4.58579 6.22592C4.96086 5.85085 5.46957 5.64014 6 5.64014H18C18.5304 5.64014 19.0391 5.85085 19.4142 6.22592C19.7893 6.601 20 7.1097 20 7.64014V19.6401C20 20.1706 19.7893 20.6793 19.4142 21.0543C19.0391 21.4294 18.5304 21.6401 18 21.6401H6C5.46957 21.6401 4.96086 21.4294 4.58579 21.0543C4.21071 20.6793 4 20.1706 4 19.6401V7.64014Z"
                                stroke="#02A3ED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M16 3.64014V7.64014" stroke="#02A3ED" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M8 3.64014V7.64014" stroke="#02A3ED" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M4 11.6401H20" stroke="#02A3ED" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M8 15.6401H10V17.6401H8V15.6401Z" stroke="#02A3ED" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Rezervasiya tarixini təyin et
                    </button>
                    <div class="containerIsCheck-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Seç</th>
                                    <th>Tarix</th>
                                    <th>Konteyner adı</th>
                                    <th>Həcmi</th>
                                    <th>Yoxlama səbəbi</th>
                                    <th>Qeyd</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($booking_date_containers as $booking_date_container)
                                    <tr>
                                        <td><input value="{{ $booking_date_container->container_id }}"
                                                onchange="get_container_ids()" class="container-id" type="checkbox"></td>
                                        <td>{{ $booking_date_container->booking_date->date->format('d.m.Y') }}</td>
                                        <td>{{ $booking_date_container->container->code }}</td>
                                        <td>{{ $booking_date_container->container->volume }}</td>
                                        <td>{{ $booking_date_container->container_check_reason?->name ?? 'Yoxdur' }}</td>
                                        <td>{{ $booking_date_container->note ?? 'Yoxdur' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="pagination">
                    <a href="" class="prev">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 5L9 12L15 19" stroke="#fff" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </a>
                    <a href="" class="pagination_item active">1</a>
                    <a href="" class="pagination_item">2</a>
                    <p class="pagination_item">...</p>
                    <a href="" class="pagination_item">10</a>
                    <a href="" class="next">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 5L15 12L9 19" stroke="#fff" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
            </div>
        @endcan
    </div>
    @include('back.pages.booking-date.section.change-booking-status')
    @include('back.pages.booking-date.section.set-container-date-modal')
@endsection

@push('js')
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
        function get_booking_date(id) {
            event.preventDefault();
            let url = `/booking-date/${id}`;
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    let container_names = document.querySelector('#containers .containers-names');
                    container_names.innerHTML = '';
                    document.querySelector('[name="booking_date_id"]').value = data.id;
                    document.querySelector('#booking_date p').innerText = data.date;
                    document.querySelector('#total_cbm p').innerText = data.total_cbm;
                    document.querySelector('#remainder_cbm p').innerText = data.remainder_cbm;
                    document.querySelector('#container_count p').innerText = data.container_count;
                    document.querySelector('#remainder_count p').innerText = data.remainder_count;
                    data.containers.forEach(container => {
                        container_names.innerHTML += `
                        <div class="containers-name-item">
                            <input type="checkbox" id="${container.container.code}" value="${container.container_id}" name="container_id[]">
                            <h4 class="container-name">
                                <label for="${container.container.code}" >${container.container.code}</label>
                            </h4>
                        </div>`;
                    });

                    document.querySelector('.reservateDateView-container').style.display = 'block';
                });
        }



        function close_booking_date() {
            let reservateDateViewContainer = document.querySelector('.reservateDateView-container');
            reservateDateViewContainer.innerHTML = '';
        }

        function change_booking_date_status(item) {
            let action = item.getAttribute('data-action');
            let id = item.getAttribute('data-id');
            let form = document.querySelector('.editReservateDate_modal_container form');
            let url = `/booking-date/${id}/get-status-info`;
            form.setAttribute('action', action);
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        console.log(data);
                        let booking_data = data.data;
                        let approxDeliveyDate = document.querySelector('.approxDeliveyDate span');
                        approxDeliveyDate.innerText = booking_data.date;
                        let statuses = booking_data.statuses;
                        let status_levels = document.querySelector('.status_levels');
                        status_levels.innerHTML = '';
                        statuses.forEach((status, index) => {
                            status_levels.innerHTML += `<div class="level-item ${status.is_active == 1 ? 'active' : ''}">
                                        <div class="item-main">
                                            <div class="icon">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5 12L10 17L20 7" stroke="white" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                            <div class="itemDesc">
                                                <p>${status.name}</p>
                                                ${status.date != null ? `<span>${status.date}</span>` : ''}
                                            </div>
                                        </div>
                                        ${index !== statuses.length - 1 ? '<div class="item-line"></div>' : ''}
                                    </div>`;
                        });
                        let current_status = booking_data.current_status;
                        let status_id = document.querySelector('[name="status_id"]');
                        if (current_status) {
                            status_id.value = current_status;
                            $(status_id).niceSelect('update');
                        }
                    }
                });
        }
    </script>

    <script>
        function get_container_ids() {
            let container_ids = [];
            let containers = document.querySelectorAll('.container-id');
            containers.forEach(container => {
                if (container.checked) container_ids.push(container.value);
            });

            return container_ids;
        }

        function set_booking_date() {
            let container_ids = get_container_ids();
            document.querySelector('[name="container_ids[]"]').value = container_ids;
        }
    </script>

    <script>
        function change_status() {
            event.preventDefault();
            let action = document.querySelector('.editReservateDate_modal_container form').getAttribute('action');
            let status_id = document.querySelector('[name="status_id"]').value;
            let levelItems = document.querySelectorAll('.level-item');
            let lastActiveIndex = -1;

            levelItems.forEach((item, index) => {
                if (item.classList.contains('active')) {
                    lastActiveIndex = index;
                }
            });
            fetch(action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        '_token': "{{ csrf_token() }}",
                        'status_id': status_id,
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        toastr.success(data.message);
                        levelItems[lastActiveIndex + 1].classList.add('active');
                    } else {
                        toastr.error(data.message);
                    }
                });
        }
    </script>
@endpush
