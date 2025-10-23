@extends('back.layouts.master')

@section('content')
    <div class="reservationPrice-container">
        <div class="head-title">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22ZM12 20.8C14.3339 20.8 16.5722 19.8729 18.2225 18.2225C19.8729 16.5722 20.8 14.3339 20.8 12C20.8 9.6661 19.8729 7.42778 18.2225 5.77746C16.5722 4.12714 14.3339 3.2 12 3.2C9.6661 3.2 7.42778 4.12714 5.77746 5.77746C4.12714 7.42778 3.2 9.6661 3.2 12C3.2 14.3339 4.12714 16.5722 5.77746 18.2225C7.42778 19.8729 9.6661 20.8 12 20.8ZM11.4 10H12.6V17H11.4V10ZM12 9C11.7348 9 11.4804 8.89464 11.2929 8.70711C11.1054 8.51957 11 8.26522 11 8C11 7.73478 11.1054 7.48043 11.2929 7.29289C11.4804 7.10536 11.7348 7 12 7C12.2652 7 12.5196 7.10536 12.7071 7.29289C12.8946 7.48043 13 7.73478 13 8C13 8.26522 12.8946 8.51957 12.7071 8.70711C12.5196 8.89464 12.2652 9 12 9Z"
                    fill="#534D59" />
            </svg>
            <p>Rezervasiya qiymətləri</p>
        </div>
        @can('Rezervasiya qiymətləri page-Əlavə et')
            <button class="addReservationPriceBtn" type="button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 12H12M12 12H6M12 12V6M12 12V18" stroke="white" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                Əlavə et
            </button>
        @endcan
        <div class="tabContent-head">
            <select name="limit" onchange="filter()" id="" class="nice-select">
                <option value="10" {{ request('limit', 10) == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ request('limit', 10) == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ request('limit', 10) == 50 ? 'selected' : '' }}>50</option>
                <option value="100" {{ request('limit', 10) == 100 ? 'selected' : '' }}>100</option>
            </select>
            <select name="station_id" onchange="filter()" id="" class="select2">
                <option value="">Stansiya</option>
                @foreach ($stations as $station)
                    <option value="{{ $station->id }}" {{ request('station_id') == $station->id ? 'selected' : '' }}>
                        {{ $station->name }}</option>
                @endforeach
            </select>
            <select name="container_type_id" onchange="filter()" id="" class="nice-select">
                <option value="">Konteyner növü</option>
                @foreach ($container_types as $container_type)
                    <option value="{{ $container_type->id }}"
                        {{ request('container_type_id') == $container_type->id ? 'selected' : '' }}>
                        {{ $container_type->name . ' (' . $container_type->max_size . ')' }}</option>
                @endforeach
            </select>

        </div>
        <div class="reservationPrice-table">
            @include('back.pages.container-price.section.filter', [
                'container_prices' => $container_prices,
            ])
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

    @include('back.pages.container-price.section.edit-price', [
        'stations' => $stations,
        'container_types' => $container_types,
    ])

    @include('back.pages.container-price.section.add-price', [
        'stations' => $stations,
        'container_types' => $container_types,
    ])
@endsection

@push('css')
    <style>
        .nice-select,
        .nice-select ul {
            width: 100%;
        }
    </style>
@endpush

@push('js')
    <script>
        function get_data(item) {
            let id = item.getAttribute('data-id');
            let action = item.getAttribute('data-action');
            let form = document.querySelector('.reject_reservationPrice_modal_container form');
            form.setAttribute('action', action);
            document.querySelector('.reject_reservationPrice_modal_container').classList.add('activeModal');
            let url = `/container-price/${id}`;
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        let submitBtn = document.querySelector('.save_submitBtn');
                        let container_price = data.data;
                        let container_type_id = document.querySelector('[name="container_type_id"]');
                        let station_id = document.querySelector('[name="station_id"]');
                        let price = document.querySelector('[name="price"]');
                        container_type_id.querySelectorAll('option').forEach(option => {
                            if (option.value == container_type_id) option.selected = true;
                        });
                        station_id.value = container_price.station_id;
                        price.value = container_price.price;
                        submitBtn.setAttribute('data-action', action);

                    }
                });
        }
    </script>

    <script>
        function open_delete_modal(item) {
            let url = item.getAttribute('data-href');
            document.querySelector('.delete_setting_yes').setAttribute('href', url);
            document.querySelector('.delete_settingModal_container').classList.add('activeModal');
        }
    </script>

    <script>
        function filter(page = 1) {
            event.preventDefault();
            let limit = document.querySelector('[name="limit"]').value;
            let container_type = document.querySelector('[name="container_type_id"]').value;
            let station = document.querySelector('[name="station_id"]').value;
            let params = new URLSearchParams();
            if (page != 1) params.append("page", page);
            if (container_type) params.append('container_type_id', container_type);
            if (limit) params.append("limit", limit);
            if (station) params.append('station_id', station);

            let newUrl = `/container-price?${params.toString()}`;
            let url = `/container-price/filter?${params.toString()}`;
            history.pushState(null, "", newUrl);
            let reservationPriceTable = document.querySelector('.reservationPrice-table');
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        reservationPriceTable.innerHTML = data.view;
                    }
                });
        }
    </script>
@endpush
