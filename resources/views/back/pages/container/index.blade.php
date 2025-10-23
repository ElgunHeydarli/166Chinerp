@extends('back.layouts.master')

@section('content')
    <div class="container_order_tabContent">
        <!-- tabContent-head classli div artirildi -->
        <div class="tabContent-head">
            <div class="filterColumns">
                <select onchange="filter()" id="limit" class="nice-select">
                    <option value="10" {{ request('limit', 10) == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('limit', 10) == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('limit', 10) == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('limit', 10) == 100 ? 'selected' : '' }}>100</option>
                </select>
            </div>
            <form action="" class="table-search">
                <input type="hidden" name="limit" value="{{ request('limit', 10) }}">
                <input type="hidden" name="status" value="{{ request('status', 'accepted') }}">
                <input type="text" name="search" value="{{ request('search') }}" oninput="filter()" placeholder="Axtar">
                <button class="submitForm" type="submit">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="11.5" cy="11.5" r="9.5" stroke="#fff" stroke-width="1.5" />
                        <path d="M18.5 18.5L22 22" stroke="#fff" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </button>
            </form>
            @can('Yeni Konteynerlər page-Sifariş yarat')
                <a href="{{ route('admin.container.create') }}" class="containerOrderLink" type="button">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 12H12M12 12H6M12 12V6M12 12V18" stroke="white" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    {{ trns('add') }}
                </a>
            @endcan
        </div>

        <div class="tab-container-content container_tabContent">
            {{-- <form action="{{ route('admin.container.import') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" accept=".xlsx" class="form-control">
                <button type="submit">Import</button>
            </form> --}}
            @include('back.pages.container.section.filter', ['containers' => $containers])
        </div>
    </div>
    @include('back.pages.container.section.reject-container-modal', ['reject_reasons' => $reject_reasons])
    @include('back.pages.container.section.add-images')
@endsection

@push('css')
    <style>
        .upload_container_images {
            display: flex;
            align-items: center;
            padding: 8px;
            text-wrap: nowrap;
            border: 1px solid rgba(2, 163, 237, 0.24);
            gap: 8px;
            border-radius: 4px;
            background: transparent;
        }
    </style>
@endpush

@push('js')
    <script>
        function reject(item) {
            event.preventDefault();
            let action = item.getAttribute('data-action');
            let form = document.querySelector('.reject_container_modal_container form');
            console.log(action);
            form.setAttribute('action', action);
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

    <script>
        function filter(page = 1) {
            event.preventDefault();
            get_limit(document.getElementById('limit'));
            let limit = document.querySelector('[name="limit"]').value;
            let search = document.querySelector('[name="search"]').value;
            let status = document.querySelector('[name="status"]').value;

            let params = new URLSearchParams();
            params.append("page", page);
            if (limit) params.append("limit", limit);
            if (search) params.append("search", search);
            if (status) params.append('status', status);
            let newUrl = `/container?${params.toString()}`;
            let url = `/container/filter?${params.toString()}`;
            history.pushState(null, "", newUrl);

            fetch(url)
                .then(res => res.json())
                .then(data => {
                    let container_tabContent = document.querySelector('.container_tabContent');
                    if (data.status == 'success') {
                        container_tabContent.innerHTML = data.view;
                    } else {}
                });
        }

        function get_limit(item) {
            document.querySelector('[name="limit"]').value = item.value;
        }
    </script>

    <script>
        function add_container_images(item) {
            let id = item.getAttribute('data-id');
            let action = item.getAttribute('data-action');
            document.querySelector('.containerImgModal_container form').setAttribute('action', action);
            document.querySelector('.containerImgModal_container').classList.add('activeModal');
        }
    </script>
@endpush
