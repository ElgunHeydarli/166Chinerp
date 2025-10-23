@extends('back.layouts.master')

@section('content')
    <div class="client_tab_content">
        <div class="tabContent-head">
            <form action="" class="table-search">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Axtar">
                <input type="hidden" name="type" value="{{ request('type') }}">
                <button class="submitForm" type="submit">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="11.5" cy="11.5" r="9.5" stroke="#fff" stroke-width="1.5" />
                        <path d="M18.5 18.5L22 22" stroke="#fff" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </button>
            </form>

            {{-- <form action="{{ route('admin.customer.import') }}" method="POST" class="table-search"
                enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" placeholder="Axtar">
                <button class="submitForm" type="submit">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="11.5" cy="11.5" r="9.5" stroke="#fff" stroke-width="1.5" />
                        <path d="M18.5 18.5L22 22" stroke="#fff" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </button>
            </form> --}}
            @can('Bütün sifarişlər page - Əməliyyatlar-Əlavə et')
                <a href="{{ route('admin.customer.create') }}" class="addClientLink">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 12H12M12 12H6M12 12V6M12 12V18" stroke="white" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    Müştəri əlavə et
                </a>
            @endcan
        </div>
        <div class="client_tabContent_inner">
            <div class="client_tabContent_head">
                <a href="{{ route('admin.customer.index') }}"
                    class="client_tab_link {{ is_null(request('type')) ? 'active' : '' }}">Bütün</a>
                <a href="{{ route('admin.customer.index', ['type' => \App\Enums\CustomerType::PHYSICAL]) }}"
                    class="client_tab_link {{ request('type') == 'physical' ? 'active' : '' }}">Fiziki
                    şəxs</a>
                <a href="{{ route('admin.customer.index', ['type' => \App\Enums\CustomerType::LEGAL]) }}"
                    class="client_tab_link {{ request('type') == 'legal' ? 'active' : '' }} ">Korporativ</a>
                {{-- <a href="{{ route('admin.customer.index', ['type' => \App\Enums\CustomerType::OWNER]) }}"
                    class="client_tab_link {{ request('type') == 'owner' ? 'active' : '' }}">Fərdi
                    sahibkar</a> --}}

            </div>
            <div class="clientTable">
                <div class="clientTable-table">
                    @switch(request('type'))
                        @case('physical')
                            <table>
                                <thead>
                                    <tr>
                                        <th>Müştəri ID</th>
                                        <th>Ad Soyad</th>
                                        <th>Fin kod</th>
                                        <th>Əlaqə nömrəsi</th>
                                        @canany([
                                            'Bütün Müştərilər page - Əməliyyatlar-Bax',
                                            'Bütün Müştərilər page -
                                            Əməliyyatlar-Düzəliş et',
                                            'Bütün Müştərilər page - Əməliyyatlar-Sil',
                                            ])
                                            <th>&nbsp;</th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $customer)
                                        <tr>
                                            <td>{{ $customer->id }}</td>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->fin }}</td>
                                            <td>{{ $customer->phone }}</td>
                                            @canany([
                                                'Bütün Müştərilər page - Əməliyyatlar-Bax',
                                                'Bütün Müştərilər page -
                                                Əməliyyatlar-Düzəliş et',
                                                'Bütün Müştərilər page - Əməliyyatlar-Sil',
                                                ])
                                                <td>
                                                    <div class="client-operation">
                                                        <button class="client-operation-btn" type="button">
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
                                                        <div class="client-operation-links">
                                                            @can('Bütün Müştərilər page - Əməliyyatlar-Bax')
                                                                <a href="{{ route('admin.customer.detail', $customer->id) }}"
                                                                    class="client-operation-link client-view-link">
                                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M10 12C10 12.5304 10.2107 13.0391 10.5858 13.4142C10.9609 13.7893 11.4696 14 12 14C12.5304 14 13.0391 13.7893 13.4142 13.4142C13.7893 13.0391 14 12.5304 14 12C14 11.4696 13.7893 10.9609 13.4142 10.5858C13.0391 10.2107 12.5304 10 12 10C11.4696 10 10.9609 10.2107 10.5858 10.5858C10.2107 10.9609 10 11.4696 10 12Z"
                                                                            stroke="#534D59" stroke-width="1.5" stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                        <path
                                                                            d="M21 12C18.6 16 15.6 18 12 18C8.4 18 5.4 16 3 12C5.4 8 8.4 6 12 6C15.6 6 18.6 8 21 12Z"
                                                                            stroke="#534D59" stroke-width="1.5" stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                    </svg>
                                                                    Bax
                                                                </a>
                                                            @endcan
                                                            @can('Bütün Müştərilər page - Əməliyyatlar-Düzəliş et')
                                                                <a href="{{ route('admin.customer.edit', $customer->id) }}"
                                                                    class="client-operation-link client-edit-link">
                                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M19.5 12C19.5 11.8011 19.579 11.6103 19.7197 11.4697C19.8603 11.329 20.0511 11.25 20.25 11.25C20.4489 11.25 20.6397 11.329 20.7803 11.4697C20.921 11.6103 21 11.8011 21 12V20.25C21 20.4489 20.921 20.6397 20.7803 20.7803C20.6397 20.921 20.4489 21 20.25 21H3.75C3.55109 21 3.36032 20.921 3.21967 20.7803C3.07902 20.6397 3 20.4489 3 20.25V3.75C3 3.55109 3.07902 3.36032 3.21967 3.21967C3.36032 3.07902 3.55109 3 3.75 3H12C12.1989 3 12.3897 3.07902 12.5303 3.21967C12.671 3.36032 12.75 3.55109 12.75 3.75C12.75 3.94891 12.671 4.13968 12.5303 4.28033C12.3897 4.42098 12.1989 4.5 12 4.5H4.5V19.5H19.5V12Z"
                                                                            fill="#534D59" />
                                                                        <path
                                                                            d="M11.0145 12.9899L12.252 12.8129L19.854 5.21239C19.9256 5.1432 19.9827 5.06044 20.0221 4.96894C20.0614 4.87744 20.082 4.77902 20.0829 4.67944C20.0838 4.57985 20.0648 4.48109 20.0271 4.38892C19.9894 4.29675 19.9337 4.21301 19.8633 4.14259C19.7929 4.07217 19.7091 4.01648 19.6169 3.97877C19.5248 3.94106 19.426 3.92208 19.3264 3.92295C19.2268 3.92381 19.1284 3.9445 19.0369 3.98381C18.9454 4.02312 18.8627 4.08025 18.7935 4.15189L11.19 11.7524L11.013 12.9899H11.0145ZM20.9145 3.08989C21.1236 3.29884 21.2894 3.54694 21.4026 3.82002C21.5158 4.09309 21.574 4.38579 21.574 4.68139C21.574 4.97698 21.5158 5.26968 21.4026 5.54276C21.2894 5.81583 21.1236 6.06394 20.9145 6.27289L13.137 14.0504C13.0223 14.1655 12.8733 14.2402 12.7125 14.2634L10.2375 14.6174C10.1221 14.634 10.0045 14.6234 9.89395 14.5866C9.78339 14.5498 9.68293 14.4877 9.60053 14.4053C9.51813 14.3229 9.45607 14.2225 9.41926 14.1119C9.38245 14.0013 9.37191 13.8837 9.38848 13.7684L9.74248 11.2934C9.7652 11.1327 9.83942 10.9838 9.95398 10.8689L17.733 3.09139C18.1549 2.66958 18.7271 2.43262 19.3237 2.43262C19.9203 2.43262 20.4925 2.66958 20.9145 3.09139V3.08989Z"
                                                                            fill="#534D59" />
                                                                    </svg>
                                                                    Düzəliş et
                                                                </a>
                                                            @endcan
                                                            @can('Bütün Müştərilər page - Əməliyyatlar-Sil')
                                                                <a href="{{ route('admin.customer.destroy', $customer->id) }}"
                                                                    class="client-operation-link client-edit-link"
                                                                    onclick="delete_item(this)">
                                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
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

                            {{ $customers->withQueryString()->links('back.section.pagination') }}
                        @break

                        @case('legal')
                            <table>
                                <thead>
                                    <tr>
                                        <th>Müştəri ID</th>
                                        <th>Direktor / Ad Soyad</th>
                                        <th>Şirkət adı</th>
                                        <th>Vöen</th>
                                        <th>Əlaqə nömrəsi</th>
                                        @canany([
                                            'Bütün Müştərilər page - Əməliyyatlar-Bax',
                                            'Bütün Müştərilər page -
                                            Əməliyyatlar-Düzəliş et',
                                            'Bütün Müştərilər page - Əməliyyatlar-Sil',
                                            ])
                                            <th>&nbsp;</th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $customer)
                                        <tr>
                                            <td>{{ $customer->id }}</td>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->company_name }}</td>
                                            <td>{{ $customer->voen }}</td>
                                            <td>{{ $customer->phone }}</td>

                                            @canany([
                                                'Bütün Müştərilər page - Əməliyyatlar-Bax',
                                                'Bütün Müştərilər page -
                                                Əməliyyatlar-Düzəliş et',
                                                'Bütün Müştərilər page - Əməliyyatlar-Sil',
                                                ])
                                                <td>
                                                    <div class="client-operation">
                                                        <button class="client-operation-btn" type="button">
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
                                                        <div class="client-operation-links">
                                                            @can('Bütün Müştərilər page - Əməliyyatlar-Bax')
                                                                <a href="{{ route('admin.customer.detail', $customer->id) }}"
                                                                    class="client-operation-link client-view-link">
                                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M10 12C10 12.5304 10.2107 13.0391 10.5858 13.4142C10.9609 13.7893 11.4696 14 12 14C12.5304 14 13.0391 13.7893 13.4142 13.4142C13.7893 13.0391 14 12.5304 14 12C14 11.4696 13.7893 10.9609 13.4142 10.5858C13.0391 10.2107 12.5304 10 12 10C11.4696 10 10.9609 10.2107 10.5858 10.5858C10.2107 10.9609 10 11.4696 10 12Z"
                                                                            stroke="#534D59" stroke-width="1.5" stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                        <path
                                                                            d="M21 12C18.6 16 15.6 18 12 18C8.4 18 5.4 16 3 12C5.4 8 8.4 6 12 6C15.6 6 18.6 8 21 12Z"
                                                                            stroke="#534D59" stroke-width="1.5" stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                    </svg>
                                                                    Bax
                                                                </a>
                                                            @endcan
                                                            @can('Bütün Müştərilər page - Əməliyyatlar-Düzəliş et')
                                                                <a href="{{ route('admin.customer.edit', $customer->id) }}"
                                                                    class="client-operation-link client-edit-link">
                                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M19.5 12C19.5 11.8011 19.579 11.6103 19.7197 11.4697C19.8603 11.329 20.0511 11.25 20.25 11.25C20.4489 11.25 20.6397 11.329 20.7803 11.4697C20.921 11.6103 21 11.8011 21 12V20.25C21 20.4489 20.921 20.6397 20.7803 20.7803C20.6397 20.921 20.4489 21 20.25 21H3.75C3.55109 21 3.36032 20.921 3.21967 20.7803C3.07902 20.6397 3 20.4489 3 20.25V3.75C3 3.55109 3.07902 3.36032 3.21967 3.21967C3.36032 3.07902 3.55109 3 3.75 3H12C12.1989 3 12.3897 3.07902 12.5303 3.21967C12.671 3.36032 12.75 3.55109 12.75 3.75C12.75 3.94891 12.671 4.13968 12.5303 4.28033C12.3897 4.42098 12.1989 4.5 12 4.5H4.5V19.5H19.5V12Z"
                                                                            fill="#534D59" />
                                                                        <path
                                                                            d="M11.0145 12.9899L12.252 12.8129L19.854 5.21239C19.9256 5.1432 19.9827 5.06044 20.0221 4.96894C20.0614 4.87744 20.082 4.77902 20.0829 4.67944C20.0838 4.57985 20.0648 4.48109 20.0271 4.38892C19.9894 4.29675 19.9337 4.21301 19.8633 4.14259C19.7929 4.07217 19.7091 4.01648 19.6169 3.97877C19.5248 3.94106 19.426 3.92208 19.3264 3.92295C19.2268 3.92381 19.1284 3.9445 19.0369 3.98381C18.9454 4.02312 18.8627 4.08025 18.7935 4.15189L11.19 11.7524L11.013 12.9899H11.0145ZM20.9145 3.08989C21.1236 3.29884 21.2894 3.54694 21.4026 3.82002C21.5158 4.09309 21.574 4.38579 21.574 4.68139C21.574 4.97698 21.5158 5.26968 21.4026 5.54276C21.2894 5.81583 21.1236 6.06394 20.9145 6.27289L13.137 14.0504C13.0223 14.1655 12.8733 14.2402 12.7125 14.2634L10.2375 14.6174C10.1221 14.634 10.0045 14.6234 9.89395 14.5866C9.78339 14.5498 9.68293 14.4877 9.60053 14.4053C9.51813 14.3229 9.45607 14.2225 9.41926 14.1119C9.38245 14.0013 9.37191 13.8837 9.38848 13.7684L9.74248 11.2934C9.7652 11.1327 9.83942 10.9838 9.95398 10.8689L17.733 3.09139C18.1549 2.66958 18.7271 2.43262 19.3237 2.43262C19.9203 2.43262 20.4925 2.66958 20.9145 3.09139V3.08989Z"
                                                                            fill="#534D59" />
                                                                    </svg>
                                                                    Düzəliş et
                                                                </a>
                                                            @endcan
                                                            @can('Bütün Müştərilər page - Əməliyyatlar-Sil')
                                                                <a href="{{ route('admin.customer.destroy', $customer->id) }}"
                                                                    class="client-operation-link client-edit-link"
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

                            {{ $customers->withQueryString()->links('back.section.pagination') }}
                        @break



                        @default
                            <table>
                                <thead>
                                    <tr>
                                        <th>Müştəri ID</th>
                                        <th>Direktor/ Ad Soyad</th>
                                        <th>Şirkət adı</th>
                                        <th>Vöen</th>
                                        <th>Fin kod</th>
                                        <th>Əlaqə nömrəsi</th>
                                        @can('Bütün Müştərilər page - Əməliyyatlar-Bax|Bütün Müştərilər page -
                                            Əməliyyatlar-Düzəliş et|Bütün Müştərilər page - Əməliyyatlar-Sil')
                                            <th>&nbsp;</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $customer)
                                        <tr>
                                            <td>{{ $customer->id }}</td>
                                            <td>{{ $customer->name ?? ' - ' }}
                                            </td>
                                            <td>{{ $customer->type == 'physical' ? ' - ' : $customer->company_name }}</td>
                                            <td>{{ $customer->voen ?? ' - ' }}</td>
                                            <td>{{ $customer->fin ?? ' - ' }}</td>
                                            <td>{{ $customer->phone }}</td>

                                            @canany([
                                                'Bütün Müştərilər page - Əməliyyatlar-Bax',
                                                'Bütün Müştərilər page -
                                                Əməliyyatlar-Düzəliş et',
                                                'Bütün Müştərilər page - Əməliyyatlar-Sil',
                                                ])
                                                <td>
                                                    <div class="client-operation">
                                                        <button class="client-operation-btn" type="button">
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
                                                        <div class="client-operation-links">
                                                            @can('Bütün Müştərilər page - Əməliyyatlar-Bax')
                                                                <a href="{{ route('admin.customer.detail', $customer->id) }}"
                                                                    class="client-operation-link client-view-link">
                                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M10 12C10 12.5304 10.2107 13.0391 10.5858 13.4142C10.9609 13.7893 11.4696 14 12 14C12.5304 14 13.0391 13.7893 13.4142 13.4142C13.7893 13.0391 14 12.5304 14 12C14 11.4696 13.7893 10.9609 13.4142 10.5858C13.0391 10.2107 12.5304 10 12 10C11.4696 10 10.9609 10.2107 10.5858 10.5858C10.2107 10.9609 10 11.4696 10 12Z"
                                                                            stroke="#534D59" stroke-width="1.5" stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                        <path
                                                                            d="M21 12C18.6 16 15.6 18 12 18C8.4 18 5.4 16 3 12C5.4 8 8.4 6 12 6C15.6 6 18.6 8 21 12Z"
                                                                            stroke="#534D59" stroke-width="1.5" stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                    </svg>
                                                                    Bax
                                                                </a>
                                                            @endcan
                                                            @can('Bütün Müştərilər page - Əməliyyatlar-Düzəliş et')
                                                                <a href="{{ route('admin.customer.edit', $customer->id) }}"
                                                                    class="client-operation-link client-edit-link">
                                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M19.5 12C19.5 11.8011 19.579 11.6103 19.7197 11.4697C19.8603 11.329 20.0511 11.25 20.25 11.25C20.4489 11.25 20.6397 11.329 20.7803 11.4697C20.921 11.6103 21 11.8011 21 12V20.25C21 20.4489 20.921 20.6397 20.7803 20.7803C20.6397 20.921 20.4489 21 20.25 21H3.75C3.55109 21 3.36032 20.921 3.21967 20.7803C3.07902 20.6397 3 20.4489 3 20.25V3.75C3 3.55109 3.07902 3.36032 3.21967 3.21967C3.36032 3.07902 3.55109 3 3.75 3H12C12.1989 3 12.3897 3.07902 12.5303 3.21967C12.671 3.36032 12.75 3.55109 12.75 3.75C12.75 3.94891 12.671 4.13968 12.5303 4.28033C12.3897 4.42098 12.1989 4.5 12 4.5H4.5V19.5H19.5V12Z"
                                                                            fill="#534D59" />
                                                                        <path
                                                                            d="M11.0145 12.9899L12.252 12.8129L19.854 5.21239C19.9256 5.1432 19.9827 5.06044 20.0221 4.96894C20.0614 4.87744 20.082 4.77902 20.0829 4.67944C20.0838 4.57985 20.0648 4.48109 20.0271 4.38892C19.9894 4.29675 19.9337 4.21301 19.8633 4.14259C19.7929 4.07217 19.7091 4.01648 19.6169 3.97877C19.5248 3.94106 19.426 3.92208 19.3264 3.92295C19.2268 3.92381 19.1284 3.9445 19.0369 3.98381C18.9454 4.02312 18.8627 4.08025 18.7935 4.15189L11.19 11.7524L11.013 12.9899H11.0145ZM20.9145 3.08989C21.1236 3.29884 21.2894 3.54694 21.4026 3.82002C21.5158 4.09309 21.574 4.38579 21.574 4.68139C21.574 4.97698 21.5158 5.26968 21.4026 5.54276C21.2894 5.81583 21.1236 6.06394 20.9145 6.27289L13.137 14.0504C13.0223 14.1655 12.8733 14.2402 12.7125 14.2634L10.2375 14.6174C10.1221 14.634 10.0045 14.6234 9.89395 14.5866C9.78339 14.5498 9.68293 14.4877 9.60053 14.4053C9.51813 14.3229 9.45607 14.2225 9.41926 14.1119C9.38245 14.0013 9.37191 13.8837 9.38848 13.7684L9.74248 11.2934C9.7652 11.1327 9.83942 10.9838 9.95398 10.8689L17.733 3.09139C18.1549 2.66958 18.7271 2.43262 19.3237 2.43262C19.9203 2.43262 20.4925 2.66958 20.9145 3.09139V3.08989Z"
                                                                            fill="#534D59" />
                                                                    </svg>
                                                                    Düzəliş et
                                                                </a>
                                                            @endcan
                                                            @can('Bütün Müştərilər page - Əməliyyatlar-Sil')
                                                                <a href="{{ route('admin.customer.destroy', $customer->id) }}"
                                                                    class="client-operation-link client-edit-link"
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

                            {{ $customers->withQueryString()->links('back.section.pagination') }}
                        @break
                    @endswitch
                </div>

            </div>
        </div>

    </div>
    {{-- <div class="pagination">
        <a href="" class="prev">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15 5L9 12L15 19" stroke="#fff" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </a>
        <a href="" class="pagination_item active">1</a>
        <a href="" class="pagination_item">2</a>
        <p class="pagination_item">...</p>
        <a href="" class="pagination_item">10</a>
        <a href="" class="next">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 5L15 12L9 19" stroke="#fff" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </a>
    </div> --}}
@endsection

@push('js')
    <script>
        sort('customer');
    </script>

    <script>
        function open_delete_modal(item) {
            let url = item.getAttribute('data-href');
            document.querySelector('.delete_setting_yes').setAttribute('href', url);
        }
    </script>

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
@endpush
