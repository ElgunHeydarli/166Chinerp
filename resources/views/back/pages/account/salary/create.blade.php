@extends('back.layouts.master')

@section('content')
    <div class="addEmployee-container">
        <a href="{{ route('admin.salary.index') }}" class="backLink">
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
        <form action="{{ route('admin.salary.store') }}" method="POST" enctype="multipart/form-data"
            class="addEmployee-form">
            @csrf
            <div class="form-list">
                @include('back.pages.account.salary.section.add-user', [
                    'branches' => $branches,
                    'countries' => $countries,
                    'currencies' => $currencies,
                    'educations' => $educations,
                    'roles' => $roles,
                    'user_id' => $user_id,
                ])
            </div>
            <button onclick="add_user()" class="addNewEmp" type="button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 12H12M12 12H6M12 12V6M12 12V18" stroke="white" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                Yenisini əlavə et
            </button>
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
            item.value = item.value.replace(/[^a-zA-ZğüşıöçĞÜŞİÖÇn ]/g, "");
        }

        function convert_alphanumeric(item) {
            item.value = item.value.replace(/[^a-zA-Z0-9 ]/g, "");
        }
    </script>

    <script src="{{ asset('back/assets/js/custom.js') }}"></script>
@endpush
