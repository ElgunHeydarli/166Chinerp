@extends('back.layouts.master')

@section('content')
    <div class="addClient-container">
        <a href="{{ route('admin.customer.index') }}" class="backLink">
            <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M9.80442 17.7083L18.0112 25.9136L16.9997 26.9166L7.08301 16.9999L16.9997 7.08325L18.0112 8.08625L9.80301 16.2916H26.9163V17.7083H9.80442Z"
                    fill="black" />
            </svg>
            Geri
        </a>
        <div class="head-title">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22ZM12 20.8C14.3339 20.8 16.5722 19.8729 18.2225 18.2225C19.8729 16.5722 20.8 14.3339 20.8 12C20.8 9.6661 19.8729 7.42778 18.2225 5.77746C16.5722 4.12714 14.3339 3.2 12 3.2C9.6661 3.2 7.42778 4.12714 5.77746 5.77746C4.12714 7.42778 3.2 9.6661 3.2 12C3.2 14.3339 4.12714 16.5722 5.77746 18.2225C7.42778 19.8729 9.6661 20.8 12 20.8ZM11.4 10H12.6V17H11.4V10ZM12 9C11.7348 9 11.4804 8.89464 11.2929 8.70711C11.1054 8.51957 11 8.26522 11 8C11 7.73478 11.1054 7.48043 11.2929 7.29289C11.4804 7.10536 11.7348 7 12 7C12.2652 7 12.5196 7.10536 12.7071 7.29289C12.8946 7.48043 13 7.73478 13 8C13 8.26522 12.8946 8.51957 12.7071 8.70711C12.5196 8.89464 12.2652 9 12 9Z"
                    fill="#534D59" />
            </svg>
            <p>Yeni müştəri əlavə et</p>
        </div>
        <form action="{{ route('admin.customer.store') }}" enctype="multipart/form-data" method="POST"
            class="addClient-form">
            @csrf
            <div class="form-line">
                <div class="form-item">
                    <label for="">
                        Müştəri İD
                    </label>
                    <!-- Avotmatik yaranir -->
                    <input type="text" disabled value="{{ $customer_id }}" placeholder="text here">
                </div>
                <div class="form-item" id="name">
                    <label for="">
                        Ad soyad
                    </label>
                    <input type="text" name="name" oninput="convert_letter(this)" value="{{ old('name') }}"
                        placeholder="text here">
                </div>
                <div class="form-item" id="company_name" style="display: none;">
                    <label for="">
                        Şirkət adı
                    </label>
                    <input type="text" name="company_name" oninput="convert_letter(this)"
                        value="{{ old('company_name') }}" placeholder="text here">
                </div>
                <div class="form-item">
                    <label for="">
                        Cins
                    </label>
                    <select name="gender" id="" class="nice-select">
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Kişi</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Qadın</option>
                    </select>
                    <button class="resetSelectBtn" type="button">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.4 16.308L12 12.708L15.6 16.308L16.308 15.6L12.708 12L16.308 8.4L15.6 7.692L12 11.292L8.4 7.692L7.692 8.4L11.292 12L7.692 15.6L8.4 16.308ZM12.003 21C10.759 21 9.589 20.764 8.493 20.292C7.39767 19.8193 6.44467 19.178 5.634 18.368C4.82333 17.558 4.18167 16.606 3.709 15.512C3.23633 14.418 3 13.2483 3 12.003C3 10.7577 3.23633 9.58767 3.709 8.493C4.181 7.39767 4.82133 6.44467 5.63 5.634C6.43867 4.82333 7.391 4.18167 8.487 3.709C9.583 3.23633 10.753 3 11.997 3C13.241 3 14.411 3.23633 15.507 3.709C16.6023 4.181 17.5553 4.82167 18.366 5.631C19.1767 6.44033 19.8183 7.39267 20.291 8.488C20.7637 9.58333 21 10.753 21 11.997C21 13.241 20.764 14.411 20.292 15.507C19.82 16.603 19.1787 17.556 18.368 18.366C17.5573 19.176 16.6053 19.8177 15.512 20.291C14.4187 20.7643 13.249 21.0007 12.003 21ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                fill="#959595" />
                        </svg>
                    </button>
                </div>
                <div class="form-item">
                    <label for="">
                        FİN kod
                    </label>
                    <input type="text" name="fin" oninput="convert_alphanumeric(this)" value="{{ old('fin') }}"
                        placeholder="text here">
                </div>
                <div class="form-item">
                    <label for="">
                        VÖEN
                    </label>
                    <input type="text" name="voen" oninput="convert_numeric(this)" value="{{ old('voen') }}"
                        placeholder="text here">
                </div>
                <div class="form-item">
                    <label for="">
                        Ş.V Seriya və nömrəsi
                    </label>
                    <input type="text" name="serial_number" oninput="convert_alphanumeric(this)"
                        value="{{ old('serial_number') }}" placeholder="text here">
                </div>
                <div class="form-item">
                    <label for="">
                        Əlaqə nömrəsi
                    </label>
                    <input type="text" name="phone" oninput="convert_numeric(this)" value="{{ old('phone') }}"
                        placeholder="text here">
                </div>
                <div class="form-item">
                    <label for="">
                        Email
                    </label>
                    <input type="text" name="email" value="{{ old('email') }}" placeholder="text here">
                </div>
                <div class="form-item">
                    <label for="">
                        Mənbə
                    </label>
                    <select name="source_id" id="" class="nice-select">
                        <option value="">Seçin</option>
                        @foreach ($sources as $source)
                            <option value="{{ $source->id }}">{{ $source->name }}</option>
                        @endforeach
                    </select>
                    <button class="resetSelectBtn" type="button">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.4 16.308L12 12.708L15.6 16.308L16.308 15.6L12.708 12L16.308 8.4L15.6 7.692L12 11.292L8.4 7.692L7.692 8.4L11.292 12L7.692 15.6L8.4 16.308ZM12.003 21C10.759 21 9.589 20.764 8.493 20.292C7.39767 19.8193 6.44467 19.178 5.634 18.368C4.82333 17.558 4.18167 16.606 3.709 15.512C3.23633 14.418 3 13.2483 3 12.003C3 10.7577 3.23633 9.58767 3.709 8.493C4.181 7.39767 4.82133 6.44467 5.63 5.634C6.43867 4.82333 7.391 4.18167 8.487 3.709C9.583 3.23633 10.753 3 11.997 3C13.241 3 14.411 3.23633 15.507 3.709C16.6023 4.181 17.5553 4.82167 18.366 5.631C19.1767 6.44033 19.8183 7.39267 20.291 8.488C20.7637 9.58333 21 10.753 21 11.997C21 13.241 20.764 14.411 20.292 15.507C19.82 16.603 19.1787 17.556 18.368 18.366C17.5573 19.176 16.6053 19.8177 15.512 20.291C14.4187 20.7643 13.249 21.0007 12.003 21ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                fill="#959595" />
                        </svg>
                    </button>
                </div>
                <div class="form-item">
                    <label for="">
                        Müqavilə bağlanma tarixi
                    </label>
                    <input type="text" name="contract_start_date" class="datetimepicker" placeholder="Tarix">
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
                    <label for="">
                        Müqavilə bitmə tarixi
                    </label>
                    <input type="text" name="contract_end_date" class="datetimepicker" placeholder="Tarix">
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
                    <label for="">
                        Biz tərəfdən kurator
                    </label>
                    <select name="user_id" id="" class="nice-select">
                        <option value="">Seçin</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}</option>
                        @endforeach
                    </select>
                    <button class="resetSelectBtn" type="button">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.4 16.308L12 12.708L15.6 16.308L16.308 15.6L12.708 12L16.308 8.4L15.6 7.692L12 11.292L8.4 7.692L7.692 8.4L11.292 12L7.692 15.6L8.4 16.308ZM12.003 21C10.759 21 9.589 20.764 8.493 20.292C7.39767 19.8193 6.44467 19.178 5.634 18.368C4.82333 17.558 4.18167 16.606 3.709 15.512C3.23633 14.418 3 13.2483 3 12.003C3 10.7577 3.23633 9.58767 3.709 8.493C4.181 7.39767 4.82133 6.44467 5.63 5.634C6.43867 4.82333 7.391 4.18167 8.487 3.709C9.583 3.23633 10.753 3 11.997 3C13.241 3 14.411 3.23633 15.507 3.709C16.6023 4.181 17.5553 4.82167 18.366 5.631C19.1767 6.44033 19.8183 7.39267 20.291 8.488C20.7637 9.58333 21 10.753 21 11.997C21 13.241 20.764 14.411 20.292 15.507C19.82 16.603 19.1787 17.556 18.368 18.366C17.5573 19.176 16.6053 19.8177 15.512 20.291C14.4187 20.7643 13.249 21.0007 12.003 21ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                fill="#959595" />
                        </svg>
                    </button>
                </div>
                <div class="form-item">
                    <label for="">
                        Müştərinin yaranma tarixi
                    </label>
                    <input type="text" name="date" autocomplete="off" class="datetimepicker" placeholder="Tarix">
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
                    <label for="">
                        Müştəri növü
                    </label>
                    <select name="type" onchange="change_customer_type(this)" id="" class="nice-select">
                        <option value="physical" {{ old('type') == 'physical' ? 'selected' : '' }}>Fiziki səxs
                        </option>
                        <option value="legal" {{ old('type') == 'legal' ? 'selected' : '' }}>Korporativ</option>
                        {{-- <option value="owner" {{ old('type') == 'owner' ? 'selected' : '' }}>Fərdi sahibkar
                        </option> --}}
                    </select>
                    <button class="resetSelectBtn" type="button">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.4 16.308L12 12.708L15.6 16.308L16.308 15.6L12.708 12L16.308 8.4L15.6 7.692L12 11.292L8.4 7.692L7.692 8.4L11.292 12L7.692 15.6L8.4 16.308ZM12.003 21C10.759 21 9.589 20.764 8.493 20.292C7.39767 19.8193 6.44467 19.178 5.634 18.368C4.82333 17.558 4.18167 16.606 3.709 15.512C3.23633 14.418 3 13.2483 3 12.003C3 10.7577 3.23633 9.58767 3.709 8.493C4.181 7.39767 4.82133 6.44467 5.63 5.634C6.43867 4.82333 7.391 4.18167 8.487 3.709C9.583 3.23633 10.753 3 11.997 3C13.241 3 14.411 3.23633 15.507 3.709C16.6023 4.181 17.5553 4.82167 18.366 5.631C19.1767 6.44033 19.8183 7.39267 20.291 8.488C20.7637 9.58333 21 10.753 21 11.997C21 13.241 20.764 14.411 20.292 15.507C19.82 16.603 19.1787 17.556 18.368 18.366C17.5573 19.176 16.6053 19.8177 15.512 20.291C14.4187 20.7643 13.249 21.0007 12.003 21ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                fill="#959595" />
                        </svg>
                    </button>
                </div>
                <div class="form-item">
                    <label for="">
                        Müqavilə nömrəsi
                    </label>
                    <input type="text" name="contract_number" value="{{ old('contract_number') }}"
                        placeholder="text here">
                </div>

                <div class="form-item">
                    <label for="">
                        Ödəniş şərti
                    </label>
                    <select name="payment_term_id" id="" class="nice-select">
                        <option value="">Seçim edin</option>
                        @foreach ($payment_terms as $payment_term)
                            <option value="{{ $payment_term->id }}"
                                {{ old('payment_term_id') == $payment_term->id ? 'selected' : '' }}>
                                {{ $payment_term->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="contract-file-item">
                    <div class="file-area">
                        <p>
                            Müqavilə əlavə et
                            <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.616 16.577H7.077C5.949 16.577 4.98767 16.1797 4.193 15.385C3.39833 14.5903 3.00067 13.6287 3 12.5C2.99933 11.3713 3.397 10.4097 4.193 9.615C4.989 8.82033 5.95033 8.42266 7.077 8.422H10.616V9.422H7.077C6.23033 9.422 5.506 9.72333 4.904 10.326C4.30133 10.9293 4 11.654 4 12.5C4 13.346 4.30133 14.0703 4.904 14.673C5.50667 15.2757 6.231 15.577 7.077 15.577H10.616V16.577ZM8.5 13V12H15.5V13H8.5ZM13.385 16.577V15.577H16.923C17.7697 15.577 18.494 15.2757 19.096 14.673C19.6987 14.0703 20 13.346 20 12.5C20 11.654 19.6987 10.9297 19.096 10.327C18.4933 9.72433 17.769 9.423 16.923 9.423H13.385V8.423H16.923C18.051 8.423 19.0127 8.82033 19.808 9.615C20.6033 10.4097 21.0007 11.3713 21 12.5C20.9993 13.6287 20.6017 14.5903 19.807 15.385C19.0123 16.1797 18.051 16.5773 16.923 16.578L13.385 16.577Z"
                                    fill="white"></path>
                            </svg>
                        </p>
                        <input name="contract" type="file">
                        <span class="fileName"></span>
                    </div>
                </div>
                <div class="contract-file-item">
                    <div class="file-area">
                        <p>
                            Hesab faktura
                            <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.616 16.577H7.077C5.949 16.577 4.98767 16.1797 4.193 15.385C3.39833 14.5903 3.00067 13.6287 3 12.5C2.99933 11.3713 3.397 10.4097 4.193 9.615C4.989 8.82033 5.95033 8.42266 7.077 8.422H10.616V9.422H7.077C6.23033 9.422 5.506 9.72333 4.904 10.326C4.30133 10.9293 4 11.654 4 12.5C4 13.346 4.30133 14.0703 4.904 14.673C5.50667 15.2757 6.231 15.577 7.077 15.577H10.616V16.577ZM8.5 13V12H15.5V13H8.5ZM13.385 16.577V15.577H16.923C17.7697 15.577 18.494 15.2757 19.096 14.673C19.6987 14.0703 20 13.346 20 12.5C20 11.654 19.6987 10.9297 19.096 10.327C18.4933 9.72433 17.769 9.423 16.923 9.423H13.385V8.423H16.923C18.051 8.423 19.0127 8.82033 19.808 9.615C20.6033 10.4097 21.0007 11.3713 21 12.5C20.9993 13.6287 20.6017 14.5903 19.807 15.385C19.0123 16.1797 18.051 16.5773 16.923 16.578L13.385 16.577Z"
                                    fill="white"></path>
                            </svg>
                        </p>
                        <input name="bill_invoice" type="file">
                        <span class="fileName"></span>
                    </div>
                </div>
                <div class="contract-file-item">
                    <div class="file-area">
                        <p>
                            Təhvil-təslim aktı
                            <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.616 16.577H7.077C5.949 16.577 4.98767 16.1797 4.193 15.385C3.39833 14.5903 3.00067 13.6287 3 12.5C2.99933 11.3713 3.397 10.4097 4.193 9.615C4.989 8.82033 5.95033 8.42266 7.077 8.422H10.616V9.422H7.077C6.23033 9.422 5.506 9.72333 4.904 10.326C4.30133 10.9293 4 11.654 4 12.5C4 13.346 4.30133 14.0703 4.904 14.673C5.50667 15.2757 6.231 15.577 7.077 15.577H10.616V16.577ZM8.5 13V12H15.5V13H8.5ZM13.385 16.577V15.577H16.923C17.7697 15.577 18.494 15.2757 19.096 14.673C19.6987 14.0703 20 13.346 20 12.5C20 11.654 19.6987 10.9297 19.096 10.327C18.4933 9.72433 17.769 9.423 16.923 9.423H13.385V8.423H16.923C18.051 8.423 19.0127 8.82033 19.808 9.615C20.6033 10.4097 21.0007 11.3713 21 12.5C20.9993 13.6287 20.6017 14.5903 19.807 15.385C19.0123 16.1797 18.051 16.5773 16.923 16.578L13.385 16.577Z"
                                    fill="white"></path>
                            </svg>
                        </p>
                        <input name="handover" type="file">
                        <span class="fileName"></span>
                    </div>
                </div>
                <div class="contract-file-item">
                    <div class="file-area">
                        <p>
                            Qiymət razılaşması protokolu
                            <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.616 16.577H7.077C5.949 16.577 4.98767 16.1797 4.193 15.385C3.39833 14.5903 3.00067 13.6287 3 12.5C2.99933 11.3713 3.397 10.4097 4.193 9.615C4.989 8.82033 5.95033 8.42266 7.077 8.422H10.616V9.422H7.077C6.23033 9.422 5.506 9.72333 4.904 10.326C4.30133 10.9293 4 11.654 4 12.5C4 13.346 4.30133 14.0703 4.904 14.673C5.50667 15.2757 6.231 15.577 7.077 15.577H10.616V16.577ZM8.5 13V12H15.5V13H8.5ZM13.385 16.577V15.577H16.923C17.7697 15.577 18.494 15.2757 19.096 14.673C19.6987 14.0703 20 13.346 20 12.5C20 11.654 19.6987 10.9297 19.096 10.327C18.4933 9.72433 17.769 9.423 16.923 9.423H13.385V8.423H16.923C18.051 8.423 19.0127 8.82033 19.808 9.615C20.6033 10.4097 21.0007 11.3713 21 12.5C20.9993 13.6287 20.6017 14.5903 19.807 15.385C19.0123 16.1797 18.051 16.5773 16.923 16.578L13.385 16.577Z"
                                    fill="white"></path>
                            </svg>
                        </p>
                        <input name="price_agreement_protocol" type="file">
                        <span class="fileName"></span>
                    </div>
                </div>
            </div>
            <div class="form-note">
                <label for="">
                    Qeyd
                </label>
                <textarea name="note" id="" placeholder="Qeyd">{{ old('note') }}</textarea>
            </div>
            <div class="clientFile-container">
                <div class="clientFile-box">
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
                    <div class="clientFile-body">
                        <p>Select a file or drag and drop here</p>
                        <span>JPG, XLSX or PDF, file size no more than 10MB</span>
                    </div>
                    <div class="selectFile">Select file</div>
                    <input type="file" name="files[]" multiple>
                </div>
                <div class="clientFile-fileUpload">

                </div>

            </div>
            @include('back.pages.customer.section.property')

            <button class="submitAddClient" type="submit">Təsdiq</button>
        </form>
    </div>
@endsection

@push('js')
    <script>
        function change_customer_type(item) {
            let value = item.value;
            let requisites = document.querySelector('.requisites');
            if (value == 'owner' || value == 'legal') {
                requisites.style.display = 'flex';
                document.querySelector('#company_name').style.display = 'block';
                document.querySelector('#name label').innerText = 'Direktor Ad/Soyad';
            } else {
                requisites.style.display = 'none';
                document.querySelector('#company_name').style.display = 'none';
                document.querySelector('#name label').innerText = 'Ad/Soyad';
            }
        }

        function add_person() {
            let url = `/customer/add-person`;
            let responsible_person_list = document.querySelector('.responsible_person-list');
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        responsible_person_list.insertAdjacentHTML('beforeend', data.view);
                    } else {
                        alert(data.message);
                    }
                })
        }

        function delete_person(item) {
            let parentElement = item.parentElement;
            parentElement.remove();
        }
    </script>

    <script>
        function convert_numeric(item) {
            item.value = item.value.replace(/\D/g, "");
            if (item.value.startsWith("0")) {
                item.value = item.value.replace(/^0+/, '');
            }
        }

        function convert_letter(item) {
            item.value = item.value.replace(/[^a-zA-ZğüşıöƏəçĞÜŞİÖÇn ]/g, "");
        }

        function convert_alphanumeric(item) {
            item.value = item.value.replace(/[^a-zA-Z0-9 əƏıİöÖüÜçÇşŞğĞ]/g, "");
        }
    </script>

    <script>
        document.querySelectorAll(".clientFile-container").forEach((container) => {
            const clientFileInput = container.querySelector('input[type="file"]');
            const clientFileUpload = container.querySelector(".clientFile-fileUpload");

            // Sayfa yüklendiğinde mevcut dosyalar için silme eventini ekle
            container.querySelectorAll(".removeClientFile").forEach((item) => {
                item.addEventListener("click", () => {
                    item.parentElement.remove();
                });
            });

            clientFileInput?.addEventListener("change", async () => {
                if (clientFileInput.files.length > 0) {
                    [...clientFileInput.files].forEach(async (file) => {
                        const clientFileUploadArea = document.createElement("div");
                        clientFileUploadArea.className = "clientFile-fileUpload-area";

                        clientFileUploadArea.innerHTML = `
                    <img src="{{ asset('back/assets') }}/images/pdfImg.svg" alt="">
                    <div class="clientFile-fileUpload-main">
                        <div class="clientFile-fileUpload-top">
                            <span class="clientFile-FileName">${file.name}</span>
                            <p class="clientFile-fileSize">${(
                        file.size /
                        (1024 * 1024)
                    ).toFixed(2)} MB</p>
                        </div>
                        <div class="clientFile-fileProgress">
                            <div class="uploadLine"></div>
                        </div>
                    </div>
                    <button class="removeClientFile" type="button">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.5 4.5L4.5 13.5M4.5 4.5L13.5 13.5" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                `;

                        clientFileUpload.appendChild(clientFileUploadArea);

                        const clientFile_uploadLine = clientFileUploadArea.querySelector(
                            ".uploadLine");
                        clientFile_uploadLine.style.transition = "none";
                        clientFile_uploadLine.style.width = "0%";

                        await new Promise((resolve) => setTimeout(resolve, 100));

                        clientFile_uploadLine.style.transition = "width 0.5s linear";
                        simulateFileUploadProgress(clientFile_uploadLine);

                        // Yeni eklenen butona silme eventini ekle
                        const removeButton = clientFileUploadArea.querySelector(
                            ".removeClientFile");
                        removeButton.addEventListener("click", () => {
                            clientFileUploadArea.remove();
                        });
                    });
                }
                // clientFileInput.value = ""; // Aynı dosyayı tekrar seçebilmek için input temizlendi
            });
        });

        const simulateFileUploadProgress = (progressElement) => {
            let progress = 0;
            const interval = setInterval(() => {
                progress += 10;
                progressElement.style.width = `${progress}%`;
                if (progress >= 100) clearInterval(interval);
            }, 50);
        }
    </script>
@endpush
