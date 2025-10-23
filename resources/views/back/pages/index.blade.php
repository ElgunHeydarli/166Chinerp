@extends('back.layouts.master')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>

    <div class="dashboard-container">
        <div class="dashboard-dates">
            <button class="date-box" type="button" id="konteyner1">
                <div class="icon">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M19.25 5.83333V3.5M8.75 5.83333V3.5M3.79167 9.33333H24.2083M3.5 11.718C3.5 9.2505 3.5 8.01617 4.00867 7.0735C4.46862 6.23269 5.18233 5.55859 6.048 5.14733C7.04667 4.66667 8.35333 4.66667 10.9667 4.66667H17.0333C19.6467 4.66667 20.9533 4.66667 21.952 5.14733C22.8305 5.56967 23.5433 6.244 23.9913 7.07233C24.5 8.01733 24.5 9.25167 24.5 11.7192V17.4498C24.5 19.9173 24.5 21.1517 23.9913 22.0943C23.5314 22.9351 22.8177 23.6092 21.952 24.0205C20.9533 24.5 19.6467 24.5 17.0333 24.5H10.9667C8.35333 24.5 7.04667 24.5 6.048 24.0193C5.1825 23.6084 4.46881 22.9347 4.00867 22.0943C3.5 21.1493 3.5 19.915 3.5 17.4475V11.718Z"
                            stroke="#02A3ED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="time">
                    <p>12.02.2025</p>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 9L12 15L18 9" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
            </button>
            <button class="date-box" type="button" id="konteyner2">
                <div class="icon">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M19.25 5.83333V3.5M8.75 5.83333V3.5M3.79167 9.33333H24.2083M3.5 11.718C3.5 9.2505 3.5 8.01617 4.00867 7.0735C4.46862 6.23269 5.18233 5.55859 6.048 5.14733C7.04667 4.66667 8.35333 4.66667 10.9667 4.66667H17.0333C19.6467 4.66667 20.9533 4.66667 21.952 5.14733C22.8305 5.56967 23.5433 6.244 23.9913 7.07233C24.5 8.01733 24.5 9.25167 24.5 11.7192V17.4498C24.5 19.9173 24.5 21.1517 23.9913 22.0943C23.5314 22.9351 22.8177 23.6092 21.952 24.0205C20.9533 24.5 19.6467 24.5 17.0333 24.5H10.9667C8.35333 24.5 7.04667 24.5 6.048 24.0193C5.1825 23.6084 4.46881 22.9347 4.00867 22.0943C3.5 21.1493 3.5 19.915 3.5 17.4475V11.718Z"
                            stroke="#02A3ED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="time">
                    <p>12.02.2025</p>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 9L12 15L18 9" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
            </button>
            <button class="date-box" type="button" id="konteyner3">
                <div class="icon">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M19.25 5.83333V3.5M8.75 5.83333V3.5M3.79167 9.33333H24.2083M3.5 11.718C3.5 9.2505 3.5 8.01617 4.00867 7.0735C4.46862 6.23269 5.18233 5.55859 6.048 5.14733C7.04667 4.66667 8.35333 4.66667 10.9667 4.66667H17.0333C19.6467 4.66667 20.9533 4.66667 21.952 5.14733C22.8305 5.56967 23.5433 6.244 23.9913 7.07233C24.5 8.01733 24.5 9.25167 24.5 11.7192V17.4498C24.5 19.9173 24.5 21.1517 23.9913 22.0943C23.5314 22.9351 22.8177 23.6092 21.952 24.0205C20.9533 24.5 19.6467 24.5 17.0333 24.5H10.9667C8.35333 24.5 7.04667 24.5 6.048 24.0193C5.1825 23.6084 4.46881 22.9347 4.00867 22.0943C3.5 21.1493 3.5 19.915 3.5 17.4475V11.718Z"
                            stroke="#02A3ED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="time">
                    <p>12.02.2025</p>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 9L12 15L18 9" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
            </button>
            <button class="date-box" type="button" id="konteyner4">
                <div class="icon">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M19.25 5.83333V3.5M8.75 5.83333V3.5M3.79167 9.33333H24.2083M3.5 11.718C3.5 9.2505 3.5 8.01617 4.00867 7.0735C4.46862 6.23269 5.18233 5.55859 6.048 5.14733C7.04667 4.66667 8.35333 4.66667 10.9667 4.66667H17.0333C19.6467 4.66667 20.9533 4.66667 21.952 5.14733C22.8305 5.56967 23.5433 6.244 23.9913 7.07233C24.5 8.01733 24.5 9.25167 24.5 11.7192V17.4498C24.5 19.9173 24.5 21.1517 23.9913 22.0943C23.5314 22.9351 22.8177 23.6092 21.952 24.0205C20.9533 24.5 19.6467 24.5 17.0333 24.5H10.9667C8.35333 24.5 7.04667 24.5 6.048 24.0193C5.1825 23.6084 4.46881 22.9347 4.00867 22.0943C3.5 21.1493 3.5 19.915 3.5 17.4475V11.718Z"
                            stroke="#02A3ED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="time">
                    <p>12.02.2025</p>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 9L12 15L18 9" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
            </button>
        </div>



<div class="grid grid-cols-1 md:grid-cols-4 gap-6 my-6">
    {{-- Bugünkü xərclər --}}
    <div class="bg-white p-4 rounded-xl shadow flex items-center gap-4 border-l-4 border-red-500">
        <div class="text-3xl">💰</div>
        <div>
            <p class="text-gray-500 text-sm font-medium">Bugünkü xərclər</p>
            <p class="text-xl font-semibold text-red-600">{{ number_format($todayExpenses, 2) }} ₼</p>
        </div>
    </div>

    {{-- Bugünkü gəlirlər --}}
    <div class="bg-white p-4 rounded-xl shadow flex items-center gap-4 border-l-4 border-green-500">
        <div class="text-3xl">📥</div>
        <div>
            <p class="text-gray-500 text-sm font-medium">Bugünkü gəlirlər</p>
            <p class="text-xl font-semibold text-green-600">{{ number_format($todayIncomes, 2) }} ₼</p>
        </div>
    </div>

    {{-- Ay ərzində əməkhaqqı alanlar --}}
    <div class="bg-white p-4 rounded-xl shadow flex items-center gap-4 border-l-4 border-blue-500">
        <div class="text-3xl">👨‍💼</div>
        <div>
            <p class="text-gray-500 text-sm font-medium">Ay ərzində əməkhaqqı alanlar</p>
            <p class="text-xl font-semibold text-blue-600">{{ $monthlyPayrolls }}</p>
        </div>
    </div>

    {{-- Aktiv vendor borcu --}}
    <div class="bg-white p-4 rounded-xl shadow flex items-center gap-4 border-l-4 border-yellow-500">
        <div class="text-3xl">🧾</div>
        <div>
            <p class="text-gray-500 text-sm font-medium">Aktiv vendor borcu</p>
            <p class="text-xl font-semibold text-yellow-500">{{ number_format($pendingVendorPayments, 2) }} ₼</p>
        </div>
    </div>
</div>



        <div class="dashboard-main">
            <div class="dashboard-head">
                <div class="head-target">
                    <div class="icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11 12C11 12.2652 11.1054 12.5196 11.2929 12.7071C11.4804 12.8946 11.7348 13 12 13C12.2652 13 12.5196 12.8946 12.7071 12.7071C12.8946 12.5196 13 12.2652 13 12C13 11.7348 12.8946 11.4804 12.7071 11.2929C12.5196 11.1054 12.2652 11 12 11C11.7348 11 11.4804 11.1054 11.2929 11.2929C11.1054 11.4804 11 11.7348 11 12Z"
                                stroke="#02A3ED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M12 7C11.0111 7 10.0444 7.29324 9.22215 7.84265C8.39991 8.39206 7.75904 9.17295 7.3806 10.0866C7.00217 11.0002 6.90315 12.0055 7.09608 12.9755C7.289 13.9454 7.76521 14.8363 8.46447 15.5355C9.16373 16.2348 10.0546 16.711 11.0246 16.9039C11.9945 17.0969 12.9998 16.9978 13.9134 16.6194C14.827 16.241 15.6079 15.6001 16.1574 14.7779C16.7068 13.9556 17 12.9889 17 12"
                                stroke="#02A3ED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M13 3.05514C11.1461 2.84715 9.2733 3.22042 7.64079 4.12331C6.00827 5.0262 4.69667 6.41409 3.88743 8.095C3.07818 9.77591 2.81128 11.6667 3.12365 13.506C3.43601 15.3452 4.31221 17.0419 5.63103 18.3614C6.94985 19.6809 8.64611 20.5579 10.4852 20.8712C12.3242 21.1845 14.2152 20.9186 15.8965 20.1102C17.5779 19.3018 18.9664 17.9909 19.8701 16.3588C20.7738 14.7267 21.148 12.8542 20.941 11.0001"
                                stroke="#02A3ED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M15 6V9H18L21 6H18V3L15 6Z" stroke="#02A3ED" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M15 9L12 12" stroke="#02A3ED" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <p>Hədəf: <span>200</span></p>
                </div>
                <div class="current-result">
                    <div class="icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9 5H7C6.46957 5 5.96086 5.21071 5.58579 5.58579C5.21071 5.96086 5 6.46957 5 7V19C5 19.5304 5.21071 20.0391 5.58579 20.4142C5.96086 20.7893 6.46957 21 7 21H17C17.5304 21 18.0391 20.7893 18.4142 20.4142C18.7893 20.0391 19 19.5304 19 19V7C19 6.46957 18.7893 5.96086 18.4142 5.58579C18.0391 5.21071 17.5304 5 17 5H15"
                                stroke="#08B839" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M9 5C9 4.46957 9.21071 3.96086 9.58579 3.58579C9.96086 3.21071 10.4696 3 11 3H13C13.5304 3 14.0391 3.21071 14.4142 3.58579C14.7893 3.96086 15 4.46957 15 5C15 5.53043 14.7893 6.03914 14.4142 6.41421C14.0391 6.78929 13.5304 7 13 7H11C10.4696 7 9.96086 6.78929 9.58579 6.41421C9.21071 6.03914 9 5.53043 9 5Z"
                                stroke="#08B839" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9 17V12" stroke="#08B839" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M12 17V16" stroke="#08B839" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M15 17V14" stroke="#08B839" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <p>Hazırki nəticə: <span>125</span></p>
                </div>
            </div>
            <div class="dashboard-konteyners">
                <div class="konteyner" data-id="konteyner1">
                    <p class="konteyner-name">TENU1268594568</p>
                    <div class="konteyner-box">
                        <div class="box-inner" style="width: 0%"></div>
                        <img src="{{ asset('back/assets') }}/images/kontainer_decor.svg" alt=""
                            class="box-decor" />
                    </div>
                    <p class="empty-space">Boş yer: <span>0sm</span></p>
                </div>
                <div class="konteyner" data-id="konteyner2">
                    <p class="konteyner-name">TENU1268594568</p>
                    <div class="konteyner-box">
                        <div class="box-inner" style="width: 20%"></div>
                        <img src="{{ asset('back/assets') }}/images/kontainer_decor.svg" alt=""
                            class="box-decor" />
                    </div>
                    <p class="empty-space">Boş yer: <span>0sm</span></p>
                </div>
                <div class="konteyner" data-id="konteyner1">
                    <p class="konteyner-name">TENU1268594568</p>
                    <div class="konteyner-box">
                        <div class="box-inner" style="width: 70%"></div>
                        <img src="{{ asset('back/assets') }}/images/kontainer_decor.svg" alt=""
                            class="box-decor" />
                    </div>
                    <p class="empty-space">Boş yer: <span>0sm</span></p>
                </div>
                <div class="konteyner" data-id="konteyner2">
                    <p class="konteyner-name">TENU1268594568</p>
                    <div class="konteyner-box">
                        <div class="box-inner" style="width: 20%"></div>
                        <img src="{{ asset('back/assets') }}/images/kontainer_decor.svg" alt=""
                            class="box-decor" />
                    </div>
                    <p class="empty-space">Boş yer: <span>0sm</span></p>
                </div>
                <div class="konteyner" data-id="konteyner3">
                    <p class="konteyner-name">TENU1268594568</p>
                    <div class="konteyner-box">
                        <div class="box-inner" style="width: 80%"></div>
                        <img src="{{ asset('back/assets') }}/images/kontainer_decor.svg" alt=""
                            class="box-decor" />
                    </div>
                    <p class="empty-space">Boş yer: <span>0sm</span></p>
                </div>
                <div class="konteyner" data-id="konteyner2">
                    <p class="konteyner-name">TENU1268594568</p>
                    <div class="konteyner-box">
                        <div class="box-inner" style="width: 10%"></div>
                        <img src="{{ asset('back/assets') }}/images/kontainer_decor.svg" alt=""
                            class="box-decor" />
                    </div>
                    <p class="empty-space">Boş yer: <span>0sm</span></p>
                </div>
                <div class="konteyner" data-id="konteyner3">
                    <p class="konteyner-name">TENU1268594568</p>
                    <div class="konteyner-box">
                        <div class="box-inner" style="width: 55%"></div>
                        <img src="{{ asset('back/assets') }}/images/kontainer_decor.svg" alt=""
                            class="box-decor" />
                    </div>
                    <p class="empty-space">Boş yer: <span>0sm</span></p>
                </div>
                <div class="konteyner" data-id="konteyner4">
                    <p class="konteyner-name">TENU1268594568</p>
                    <div class="konteyner-box">
                        <div class="box-inner" style="width: 5%"></div>
                        <img src="{{ asset('back/assets') }}/images/kontainer_decor.svg" alt=""
                            class="box-decor" />
                    </div>
                    <p class="empty-space">Boş yer: <span>0sm</span></p>
                </div>
                <div class="konteyner" data-id="konteyner4">
                    <p class="konteyner-name">TENU1268594568</p>
                    <div class="konteyner-box">
                        <div class="box-inner" style="width: 65%"></div>
                        <img src="{{ asset('back/assets') }}/images/kontainer_decor.svg" alt=""
                            class="box-decor" />
                    </div>
                    <p class="empty-space">Boş yer: <span>0sm</span></p>
                </div>
                <div class="konteyner" data-id="konteyner4">
                    <p class="konteyner-name">TENU1268594568</p>
                    <div class="konteyner-box">
                        <div class="box-inner" style="width: 0%"></div>
                        <img src="{{ asset('back/assets') }}/images/kontainer_decor.svg" alt=""
                            class="box-decor" />
                    </div>
                    <p class="empty-space">Boş yer: <span>0sm</span></p>
                </div>
                <div class="konteyner" data-id="konteyner1">
                    <p class="konteyner-name">TENU1268594568</p>
                    <div class="konteyner-box">
                        <div class="box-inner" style="width: 43%"></div>
                        <img src="{{ asset('back/assets') }}/images/kontainer_decor.svg" alt=""
                            class="box-decor" />
                    </div>
                    <p class="empty-space">Boş yer: <span>0sm</span></p>
                </div>
                <div class="konteyner" data-id="konteyner3">
                    <p class="konteyner-name">TENU1268594568</p>
                    <div class="konteyner-box">
                        <div class="box-inner" style="width: 68%"></div>
                        <img src="{{ asset('back/assets') }}/images/kontainer_decor.svg" alt=""
                            class="box-decor" />
                    </div>
                    <p class="empty-space">Boş yer: <span>0sm</span></p>
                </div>
            </div>
        </div>



       <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 my-6">
    {{-- Bütün sifarişlər --}}
    <a href="{{ route('admin.order.index') }}" class="bg-blue-100 hover:bg-blue-200 text-center p-4 rounded-xl shadow">
        <p class="text-sm text-gray-700">📦 Bütün sifarişlər</p>
        <p class="text-2xl font-bold text-blue-600">{{ $orderCounts['all'] ?? 0 }}</p>
    </a>

    {{-- Draft --}}
    <a href="{{ route('admin.order.index', ['status' => 'draft']) }}" class="bg-gray-100 hover:bg-gray-200 text-center p-4 rounded-xl shadow">
        <p class="text-sm text-gray-700">✏️ Draft</p>
        <p class="text-2xl font-bold text-gray-700">{{ $orderCounts['draft'] ?? 0 }}</p>
    </a>

    {{-- Təsdiqlənən --}}
    <a href="{{ route('admin.order.index', ['status' => 'confirmed']) }}" class="bg-green-100 hover:bg-green-200 text-center p-4 rounded-xl shadow">
        <p class="text-sm text-gray-700">✅ Təsdiqlənən</p>
        <p class="text-2xl font-bold text-green-600">{{ $orderCounts['confirmed'] ?? 0 }}</p>
    </a>

    {{-- İcrada olan --}}
    <a href="{{ route('admin.order.index', ['status' => 'execute']) }}" class="bg-yellow-100 hover:bg-yellow-200 text-center p-4 rounded-xl shadow">
        <p class="text-sm text-gray-700">🚚 İcrada olan</p>
        <p class="text-2xl font-bold text-yellow-600">{{ $orderCounts['in_progress'] ?? 0 }}</p>
    </a>

    {{-- İmtina olunan --}}
    <a href="{{ route('admin.order.index', ['status' => 'canceled']) }}" class="bg-red-100 hover:bg-red-200 text-center p-4 rounded-xl shadow">
        <p class="text-sm text-gray-700">❌ İmtina olunan</p>
        <p class="text-2xl font-bold text-red-600">{{ $orderCounts['rejected'] ?? 0 }}</p>
    </a>

    {{-- Bitmiş sifarişlər --}}
    <a href="{{ route('admin.order.index', ['status' => 'finished']) }}" class="bg-indigo-100 hover:bg-indigo-200 text-center p-4 rounded-xl shadow">
        <p class="text-sm text-gray-700">✅ Bitmiş sifarişlər</p>
        <p class="text-2xl font-bold text-indigo-600">{{ $orderCounts['completed'] ?? 0 }}</p>
    </a>

    {{-- Qiymət gözləyən --}}
    <a href="{{ route('admin.order.index', ['status' => 'awaiting_price']) }}" class="bg-orange-100 hover:bg-orange-200 text-center p-4 rounded-xl shadow">
        <p class="text-sm text-gray-700">💲 Qiymət gözləyən</p>
        <p class="text-2xl font-bold text-orange-600">{{ $orderCounts['awaiting_price'] ?? 0 }}</p>
    </a>

    {{-- Müştəri sayı --}}
    <a href="{{ route('admin.customer.index') }}" class="bg-orange-100 hover:bg-orange-200 text-center p-4 rounded-xl shadow">
        <p class="text-sm text-gray-700">👨‍💼 Müştəri sayı</p>
        <p class="text-2xl font-bold text-orange-600">{{ $customerCount ?? 0 }}</p>
    </a>
</div>




    </div>
@endsection
