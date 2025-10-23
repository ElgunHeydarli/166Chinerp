@extends('back.layouts.master')

@section('content')
    <div class="finance_tab_content">
        <div class="finance-head">
            <form action="" class="table-search">
                <input type="text" name="search" oninput="filter()" value="{{ request('search') }}" placeholder="Axtar" />
                <input type="hidden" name="type" value="{{ request('type') }}" />
                <button class="submitForm" type="submit">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="11.5" cy="11.5" r="9.5" stroke="#fff" stroke-width="1.5" />
                        <path d="M18.5 18.5L22 22" stroke="#fff" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </button>
            </form>
            <a href="{{ route('admin.expense.create') }}" class="addCostManagement">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 12H12M12 12H6M12 12V6M12 12V18" stroke="white" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                Xərc əlavə et
            </a>
        </div>
        <div class="finance_tabContent_inner">
            @include('back.pages.account.expense.section.tab-header')
            <div class="costManagementTable">
                <div class="costManagementTable-table">
                    @include('back.pages.account.expense.section.filter', ['expenses' => $expenses])
                </div>
            </div>
        </div>
    </div>

    <div class="delete_settingModal_container">
        <div class="delete_settingModal">
            <h2>Silməyə əminsiz?</h2>
            <button class="closeSettingModal" type="button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6L6 18M6 6L18 18" stroke="black" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
            <div class="delete_setting_buttons">
                <a href="" class="delete_setting_yes">Bəli</a>
                <button class="delete_setting_no">Xeyr</button>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function open_delete_modal(item) {
            let url = item.getAttribute('data-href');
            document.querySelector('.delete_setting_yes').setAttribute('href', url);
        }
    </script>

    <script>
        function filter(page = 1) {
            event.preventDefault();
            let search = document.querySelector('[name="search"]').value;
            let type = document.querySelector('[name="type"]').value;

            let params = new URLSearchParams();
            params.append("page", page);

            if (search) params.append("search", search);
            if (type) params.append("type", type);

            let newUrl = `/expense?${params.toString()}`;
            let url = `/expense/filter?${params.toString()}`;
            history.pushState(null, "", newUrl);

            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        let costManagementTable = document.querySelector('.costManagementTable-table');
                        costManagementTable.innerHTML = data.view;
                    }
                });
        }
    </script>
@endpush
