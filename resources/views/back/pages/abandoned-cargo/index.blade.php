@extends('back.layouts.master')

@section('content')
    <div class="unclaimed_cargo_order_tabContent">
        <!-- tabContent-head classli div artirildi -->
        <div class="tabContent-head">
            <form action="" class="table-search">
                <input type="text" placeholder="Axtar">
                <button class="submitForm" type="submit">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="11.5" cy="11.5" r="9.5" stroke="#fff" stroke-width="1.5" />
                        <path d="M18.5 18.5L22 22" stroke="#fff" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </button>
            </form>

            @can('Sahibsiz yüklər page -Sahibsiz yük əlavə et')
                <button class="addNewsUnclaimedCargo" type="button">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 12H12M12 12H6M12 12V6M12 12V18" stroke="white" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    Sahibsiz yük əlavə et
                </button>
            @endcan
        </div>
        <div class="unclaimed-cargo-table">
            <table>
                <thead>
                    <tr>
                        <th>Anbara daxil olma tarixi</th>
                        <th>Yükün şəkli</th>
                        <th>Üzərindəki əlavə məlumatlar</th>
                        @canany(['Sahibsiz yüklər page-LOG seç', 'Sahibsiz yüklər page-Təsdiq et'])
                            <th>LOG</th>
                        @endcanany
                    </tr>
                </thead>
                <tbody>
                    @foreach ($abandoned_cargos as $abandoned_cargo)
                        <tr>
                            <td>{{ $abandoned_cargo->date?->format('d/m/Y') ?? 'Yoxdur' }}</td>
                            <td>
                                <!-- Sekil yuklenende active class elave et,
                                                                                    yuklenmeyende activesiz olsun -->
                                <a href="{{ !is_null($abandoned_cargo->image) ? asset($abandoned_cargo->image) : '#' }}"
                                    class="cargo-img {{ !is_null($abandoned_cargo->image) ? 'active' : '' }}">
                                    <svg width="35" height="35" viewBox="0 0 35 35" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M28.8767 11.0757L21.4392 3.63817C21.3405 3.53954 21.2233 3.46132 21.0943 3.408C20.9653 3.35467 20.8271 3.32728 20.6875 3.32739H7.9375C7.37391 3.32739 6.83341 3.55128 6.4349 3.94979C6.03638 4.34831 5.8125 4.88881 5.8125 5.45239V28.8274C5.8125 29.391 6.03638 29.9315 6.4349 30.33C6.83341 30.7285 7.37391 30.9524 7.9375 30.9524H27.0625C27.6261 30.9524 28.1666 30.7285 28.5651 30.33C28.9636 29.9315 29.1875 29.391 29.1875 28.8274V11.8274C29.1876 11.6878 29.1602 11.5496 29.1069 11.4206C29.0536 11.2916 28.9754 11.1744 28.8767 11.0757ZM21.75 23.5149H13.25C12.9682 23.5149 12.698 23.403 12.4987 23.2037C12.2994 23.0044 12.1875 22.7342 12.1875 22.4524C12.1875 22.1706 12.2994 21.9003 12.4987 21.7011C12.698 21.5018 12.9682 21.3899 13.25 21.3899H21.75C22.0318 21.3899 22.302 21.5018 22.5013 21.7011C22.7006 21.9003 22.8125 22.1706 22.8125 22.4524C22.8125 22.7342 22.7006 23.0044 22.5013 23.2037C22.302 23.403 22.0318 23.5149 21.75 23.5149ZM21.75 19.2649H13.25C12.9682 19.2649 12.698 19.153 12.4987 18.9537C12.2994 18.7544 12.1875 18.4842 12.1875 18.2024C12.1875 17.9206 12.2994 17.6503 12.4987 17.4511C12.698 17.2518 12.9682 17.1399 13.25 17.1399H21.75C22.0318 17.1399 22.302 17.2518 22.5013 17.4511C22.7006 17.6503 22.8125 17.9206 22.8125 18.2024C22.8125 18.4842 22.7006 18.7544 22.5013 18.9537C22.302 19.153 22.0318 19.2649 21.75 19.2649ZM20.6875 11.8274V5.98364L26.5312 11.8274H20.6875Z"
                                            fill="#DDDDDD" />
                                    </svg>
                                </a>
                            </td>
                            <td>
                                <!-- pdf yuklenende active class elave et,
                                                                                    yuklenmeyende activesiz olsun -->
                                <a href="{{ !is_null($abandoned_cargo->file) ? asset($abandoned_cargo->file) : '#' }}"
                                    class="info-item {{ !is_null($abandoned_cargo->file) ? 'active' : '' }}">
                                    <svg width="35" height="35" viewBox="0 0 35 35" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M28.8767 11.0757L21.4392 3.63817C21.3405 3.53954 21.2233 3.46132 21.0943 3.408C20.9653 3.35467 20.8271 3.32728 20.6875 3.32739H7.9375C7.37391 3.32739 6.83341 3.55128 6.4349 3.94979C6.03638 4.34831 5.8125 4.88881 5.8125 5.45239V28.8274C5.8125 29.391 6.03638 29.9315 6.4349 30.33C6.83341 30.7285 7.37391 30.9524 7.9375 30.9524H27.0625C27.6261 30.9524 28.1666 30.7285 28.5651 30.33C28.9636 29.9315 29.1875 29.391 29.1875 28.8274V11.8274C29.1876 11.6878 29.1602 11.5496 29.1069 11.4206C29.0536 11.2916 28.9754 11.1744 28.8767 11.0757ZM21.75 23.5149H13.25C12.9682 23.5149 12.698 23.403 12.4987 23.2037C12.2994 23.0044 12.1875 22.7342 12.1875 22.4524C12.1875 22.1706 12.2994 21.9003 12.4987 21.7011C12.698 21.5018 12.9682 21.3899 13.25 21.3899H21.75C22.0318 21.3899 22.302 21.5018 22.5013 21.7011C22.7006 21.9003 22.8125 22.1706 22.8125 22.4524C22.8125 22.7342 22.7006 23.0044 22.5013 23.2037C22.302 23.403 22.0318 23.5149 21.75 23.5149ZM21.75 19.2649H13.25C12.9682 19.2649 12.698 19.153 12.4987 18.9537C12.2994 18.7544 12.1875 18.4842 12.1875 18.2024C12.1875 17.9206 12.2994 17.6503 12.4987 17.4511C12.698 17.2518 12.9682 17.1399 13.25 17.1399H21.75C22.0318 17.1399 22.302 17.2518 22.5013 17.4511C22.7006 17.6503 22.8125 17.9206 22.8125 18.2024C22.8125 18.4842 22.7006 18.7544 22.5013 18.9537C22.302 19.153 22.0318 19.2649 21.75 19.2649ZM20.6875 11.8274V5.98364L26.5312 11.8274H20.6875Z"
                                            fill="#DDDDDD" />
                                    </svg>
                                </a>
                            </td>
                            @canany(['Sahibsiz yüklər page-LOG seç', 'Sahibsiz yüklər page-Təsdiq et'])
                                <td>
                                    <form action="{{ route('admin.abandoned-cargo.update', $abandoned_cargo->id) }}"
                                        method="POST" class="logForm">
                                        @csrf
                                        @method('PUT')
                                        <select name="order_id" id="" class="nice-select">
                                            <option value="">LOG</option>
                                            @foreach ($orders as $order)
                                                <option value="{{ $order->id }}"
                                                    {{ $abandoned_cargo->order_id == $order->id ? 'selected' : '' }}>
                                                    {{ $order->code }}</option>
                                            @endforeach
                                        </select>
                                        <button class="submitLog" type="submit">Təsdiq et</button>
                                    </form>
                                </td>
                            @endcanany
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



    @include('back.pages.abandoned-cargo.section.add-cargo-modal')
@endsection
