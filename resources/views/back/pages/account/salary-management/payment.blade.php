@extends('back.layouts.master')

@section('content')
    <div class="empAddPay-container">
        <a href="{{ route('admin.salary-management.index') }}" class="backLink">
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
            <p>Ödəniş et</p>
        </div>
        <form method="POST" class="empAddPay-form" enctype="multipart/form-data">
            @csrf
            <div class="form-box">
                <div class="form-line">
                    <div class="form-item">
                        <label for="">
                            İşçi İD
                        </label>
                        <input type="text" value="E-00{{ $user_payroll->user_id }}" readonly>
                    </div>
                    <div class="form-item">
                        <label for="">
                            Ad
                        </label>
                        <input type="text" value="{{ $user_payroll->user->firstname }}" readonly>
                    </div>
                    <div class="form-item">
                        <label for="">
                            Soyad
                        </label>
                        <input type="text" value="{{ $user_payroll->user->lastname }}" readonly>
                    </div>
                    <div class="form-item">
                        <label for="">
                            Vəzifə
                        </label>
                        <input type="text" value="{{ $user_payroll->user->position }}" readonly>
                    </div>
                    <div class="form-item">
                        <label for="">
                            Gross ə/h
                        </label>
                        <input type="text" value="{{ $user_payroll->user->gross_salary }}" readonly>
                    </div>
                    <div class="form-item">
                        <label for="">
                            Ödəmə metodu
                        </label>
                        <select name="payment_method" class="nice-select" id="">
                            <option value="cash">Cash</option>
                            <option value="bank">Bank</option>
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
                            Nağd
                        </label>
                        <input type="text" name="cash_payment" value="{{ $user_payroll->cash_payment }}"
                            placeholder="text here">
                    </div>
                    <div class="form-item">
                        <label for="">
                            Bank
                        </label>
                        <input type="text" name="bank_payment" value="{{ $user_payroll->bank_payment }}"
                            placeholder="text here">
                    </div>
                    <div class="form-item">
                        <label for="">
                            Hökumət ödənişləri
                        </label>
                        <input type="text" name="government_payment" value="{{ $user_payroll->government_payment }}"
                            placeholder="text here">
                    </div>
                    <div class="form-item">
                        <label for="">
                            Tutulmalar
                        </label>
                        <input type="text" name="withholding_payment" value="{{ $user_payroll->withholding_payment }}"
                            placeholder="text here">
                    </div>
                    <div class="form-item">
                        <label for="">
                            Bonus
                        </label>
                        <input type="text" name="bonus" value="{{ $user_payroll->bonus }}" placeholder="text here">
                    </div>
                    <div class="avanceCheck">
                        <label for="">
                            Avans ödə
                        </label>
                        <input name="has_advance" type="checkbox">
                    </div>

                </div>
            </div>
            <div class="payAvance">
                <div class="head-title">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22ZM12 20.8C14.3339 20.8 16.5722 19.8729 18.2225 18.2225C19.8729 16.5722 20.8 14.3339 20.8 12C20.8 9.6661 19.8729 7.42778 18.2225 5.77746C16.5722 4.12714 14.3339 3.2 12 3.2C9.6661 3.2 7.42778 4.12714 5.77746 5.77746C4.12714 7.42778 3.2 9.6661 3.2 12C3.2 14.3339 4.12714 16.5722 5.77746 18.2225C7.42778 19.8729 9.6661 20.8 12 20.8ZM11.4 10H12.6V17H11.4V10ZM12 9C11.7348 9 11.4804 8.89464 11.2929 8.70711C11.1054 8.51957 11 8.26522 11 8C11 7.73478 11.1054 7.48043 11.2929 7.29289C11.4804 7.10536 11.7348 7 12 7C12.2652 7 12.5196 7.10536 12.7071 7.29289C12.8946 7.48043 13 7.73478 13 8C13 8.26522 12.8946 8.51957 12.7071 8.70711C12.5196 8.89464 12.2652 9 12 9Z"
                            fill="#534D59" />
                    </svg>
                    <p>Avans ödə</p>
                </div>
                <div class="form-box">
                    <div class="form-line">
                        <div class="form-item">
                            <label for="">
                                Ödəmə metodu
                            </label>
                            <select name="advance_payment_method" class="nice-select" id="">
                                <option value="cash">Cash</option>
                                <option value="bank">Bank</option>
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
                                Məbləğ
                            </label>
                            <input type="text" name="advance_price" placeholder="text here">
                        </div>
                    </div>
                    <div class="empPayAvanceFile-container">
                        <div class="empPayAvanceFile-box">
                            <div class="icon">
                                <svg width="48" height="48" viewBox="0 0 48 48" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M32 32L24 24L16 32" stroke="#00A3E8" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M24 24V42" stroke="#00A3E8" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M40.7809 36.78C42.7316 35.7165 44.2726 34.0337 45.1606 31.9972C46.0487 29.9607 46.2333 27.6864 45.6853 25.5334C45.1373 23.3803 43.8879 21.471 42.1342 20.1069C40.3806 18.7427 38.2226 18.0014 36.0009 18H33.4809C32.8755 15.6585 31.7472 13.4846 30.1808 11.642C28.6144 9.79927 26.6506 8.33567 24.4371 7.36118C22.2236 6.3867 19.818 5.92669 17.4011 6.01573C14.9843 6.10478 12.619 6.74057 10.4833 7.8753C8.34747 9.01003 6.49672 10.6142 5.07014 12.5671C3.64356 14.5201 2.67828 16.771 2.24686 19.1508C1.81544 21.5305 1.92911 23.977 2.57932 26.3065C3.22954 28.636 4.39938 30.7877 6.0009 32.6"
                                        stroke="#00A3E8" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M32 32L24 24L16 32" stroke="#00A3E8" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div class="empPayAvanceFile-body">
                                <p>Select a file or drag and drop here</p>
                                <span>JPG, XLSX or PDF, file size no more than 10MB</span>
                            </div>
                            <div class="selectFile">Select file</div>
                            <input type="file" name="advance_file[]" multiple>
                        </div>
                        <div class="empPayAvanceFile-fileUpload">

                        </div>

                    </div>
                </div>
            </div>
            <button class="submitAddEmployee" type="submit">Ödə</button>
        </form>
    </div>
@endsection
