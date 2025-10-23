@extends('back.layouts.master')

@section('content')
    <div class="addEmployee-container">
        <a href="{{ route('admin.user.index') }}" class="backLink">
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
            <p>Yeni işçi əlavə et</p>
        </div>
        <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data"
            class="addEmployee-form">
            @csrf
            <div class="form-list">
                <div class="form-box">
                    <div class="form-line">
                        <div class="form-item">
                            <label for="">
                                İşçi İD
                            </label>
                            <input type="text" value="{{ $user_id }}" disabled placeholder="text here">
                        </div>
                        <div class="form-item">
                            <label for="">
                                Ad
                            </label>
                            <input type="text" name="firstname" value="{{ old('firstname') }}"
                                oninput="convert_letter(this)" placeholder="text here">
                        </div>
                        <div class="form-item">
                            <label for="">
                                Soyad
                            </label>
                            <input type="text" name="lastname" value="{{ old('lastname') }}"
                                oninput="convert_letter(this)" placeholder="text here">
                        </div>
                        <div class="form-item">
                            <label for="">
                                E-mail
                            </label>
                            <input type="text" name="email" value="{{ old('email') }}" placeholder="text here">
                        </div>
                        <div class="form-item" style="position: relative">
                            <label for="">Parol</label>
                            <input type="password" name="password" placeholder="text here">
                            <div class="view-password"
                                style="position: absolute; right: 15px; bottom: 10px; z-index:99;cursor: pointer;"
                                onclick="view_password(this)">
                                <svg width="25" height="25" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.12547 14.1399C12.1255 14.1399 14.7205 12.4749 16.0555 10.0149C14.7205 7.55489 12.1255 5.88989 9.12547 5.88989C6.12547 5.88989 3.53047 7.55489 2.19547 10.0149C3.53047 12.4749 6.12547 14.1399 9.12547 14.1399ZM9.12547 5.13989C12.5455 5.13989 15.5005 7.12739 16.8955 10.0149C15.5005 12.9024 12.5455 14.8899 9.12547 14.8899C5.70547 14.8899 2.75047 12.9024 1.35547 10.0149C2.75047 7.12739 5.70547 5.13989 9.12547 5.13989ZM9.12547 6.63989C11.0005 6.63989 12.5005 8.13989 12.5005 10.0149C12.5005 11.8899 11.0005 13.3899 9.12547 13.3899C7.25047 13.3899 5.75047 11.8899 5.75047 10.0149C5.75047 8.13989 7.25047 6.63989 9.12547 6.63989ZM9.12547 7.38989C8.42928 7.38989 7.7616 7.66645 7.26931 8.15874C6.77703 8.65102 6.50047 9.3187 6.50047 10.0149C6.50047 10.7111 6.77703 11.3788 7.26931 11.871C7.7616 12.3633 8.42928 12.6399 9.12547 12.6399C9.82166 12.6399 10.4893 12.3633 10.9816 11.871C11.4739 11.3788 11.7505 10.7111 11.7505 10.0149C11.7505 9.3187 11.4739 8.65102 10.9816 8.15874C10.4893 7.66645 9.82166 7.38989 9.12547 7.38989Z"
                                        fill="black"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="form-item">
                            <label for="">
                                Rol
                            </label>
                            <select name="role" id="" class="nice-select">
                                <option value="">Seçin</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                        {{ $role->name }}</option>
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
                    </div>
                </div>
                {{-- @include('back.pages.user.section.add-user', [
                    'branches' => $branches,
                    'countries' => $countries,
                    'currencies' => $currencies,
                    'educations' => $educations,
                    'roles' => $roles,
                    'user_id' => $user_id,
                ]) --}}
            </div>
            {{-- <button onclick="add_user()" class="addNewEmp" type="button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 12H12M12 12H6M12 12V6M12 12V18" stroke="white" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                Yenisini əlavə et
            </button> --}}
            <button class="submitAddEmployee" type="submit">Təsdiq</button>
        </form>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
    </script>

    <script>
        let counter = 1;

        function add_user() {
            let url = `/user/add-user?counter=${counter}`;
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        let form_list = document.querySelector('.form-list');
                        form_list.insertAdjacentHTML('beforeend', data.view);
                        let all_selects = document.querySelectorAll('select');
                        all_selects.forEach(select => {
                            $(select).niceSelect();
                        });
                        jQuery('.datetimepicker').datetimepicker({
                            timepicker: false,
                            format: 'd.m.Y',
                            onShow: function(ct, $input) {
                                $input.off('mousewheel');
                            }
                        });
                        counter++;
                    }
                });
        }

        function delete_item(item) {
            item.parentElement.remove();
        }

        function view_password(item) {
            let password = item.previousElementSibling;
            let type = password.getAttribute('type');
            if (type == 'text') password.setAttribute('type', 'password');
            else password.setAttribute('type', 'text');
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

        function convert_letter(item) {
            item.value = item.value.replace(/[^a-zA-ZğüşıöçĞÜŞİÖÇnƏə ]/g, "");
        }

        function convert_alphanumeric(item) {
            item.value = item.value.replace(/[^a-zA-Z0-9 ]/g, "");
        }
    </script>
@endpush
